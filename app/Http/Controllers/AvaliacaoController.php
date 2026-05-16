<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Hotel;
use App\Models\PontoTuristico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    
    // Mostrar todas as avaliações (público)
     
    public function index()
    {
        $avaliacoes = Avaliacao::with(['user', 'hotel', 'pontoTuristico'])->get();
        return view('avaliacoes.index', compact('avaliacoes'));
    }

     //Mostrar uma avaliação específica (público)
    
    public function show(Avaliacao $avaliacao)
    {
        return view('avaliacoes.show', compact('avaliacao'));
    }

    //Formulário para criar nova avaliação (só autenticado)
    
    public function create()
    {
        $hoteis = Hotel::all();
        $pontos = PontoTuristico::all();
        return view('avaliacoes.create', compact('hoteis', 'pontos'));
    }

    // Guardar nova avaliação (só autenticado)
   
    public function store(Request $request)
{
    // Validação
    $request->validate([
        'hotel_id'          => 'nullable|exists:hoteis,id',
        'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
        'email'             => 'required|email',
        'comentario'        => 'nullable|string|max:1000',
        'nota'              => 'required|integer|min:1|max:5',
    ]);

    // Garantir que foi escolhido hotel OU ponto turístico
    if (is_null($request->hotel_id) && is_null($request->pontoturistico_id)) {
        return back()
            ->withErrors(['error' => 'Selecione um hotel ou um ponto turístico para avaliar.'])
            ->withInput();
    }

    // Verificar se este email já avaliou este hotel/ponto
    $duplicado = Avaliacao::where('email', $request->email)
        ->where(function ($query) use ($request) {
            if ($request->hotel_id) {
                $query->where('hotel_id', $request->hotel_id);
            }
            if ($request->pontoturistico_id) {
                $query->where('pontoturistico_id', $request->pontoturistico_id);
            }
        })->exists();

    if ($duplicado) {
        return back()
            ->withErrors(['error' => 'Este email já avaliou este item.'])
            ->withInput();
    }

    // Verificar se o email pertence a um user registado
    $user = \App\Models\User::where('email', $request->email)->first();

    // Criar avaliação
    $avaliacao = Avaliacao::create([
        'user_id'            => $user?->id, // Pode ser null (visitante)
        'hotel_id'           => $request->hotel_id,
        'pontoturistico_id'  => $request->pontoturistico_id,
        'email'              => $request->email,
        'comentario'         => $request->comentario,
        'nota'               => $request->nota,
    ]);

    return redirect()->route('avaliacoes.index')
        ->with('success', 'Avaliação criada com sucesso!');
}

     //Formulário para editar (só autor ou admin/gestor)
    
    public function edit(Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);

        $hoteis = Hotel::all();
        $pontos = PontoTuristico::all();
        return view('avaliacoes.edit', compact('avaliacao', 'hoteis', 'pontos'));
    }

     //Actualizar avaliação (só autor ou admin/gestor)
   
    public function update(Request $request, Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);

        $request->validate([
            'hotel_id'          => 'nullable|exists:hoteis,id',
            'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
            'email'    => 'required|email',
            'comentario'        => 'nullable|string|max:1000',
            'nota'           => 'required|integer|min:1|max:5',
        ]);

        if (is_null($request->hotel_id) && is_null($request->pontoturistico_id)) {
            return back()
                ->withErrors(['error' => 'Selecione um hotel ou um ponto turístico.'])
                ->withInput();
        }

        $avaliacao->update([
            'hotel_id'    => $request->hotel_id,
            'pontoturistico_id'  => $request->pontoturistico_id,
            'email'   => $request->email,
            'comentario'   => $request->comentario,
            'nota'    => $request->nota,
        ]);

        return redirect()->route('avaliacoes.index')
            ->with('success', 'Avaliação actualizada com sucesso!');
    }

     //Apagar avaliação (só autor ou admin/gestor)
     
    public function destroy(Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);
        $avaliacao->delete();
        return redirect()->route('avaliacoes.index')
            ->with('success', 'Avaliação removida com sucesso!');
    }

   //Método privado para verificar permissão (autor ou admin/gestor)
    
    private function authorizeAvaliacao(Avaliacao $avaliacao)
{
    $user = Auth::user();
    
    // Se não está logado, verificar se o email da sessão corresponde
    if (!$user) {
        // Para visitantes, você pode verificar por email na sessão
        if (session('avaliador_email') !== $avaliacao->email) {
            abort(403, 'Não tem permissão para modificar esta avaliação.');
        }
        return;
    }

    $isAuthor = $user->id === $avaliacao->user_id || $user->email === $avaliacao->email;
    $isAdminOrGestor = in_array($user->role, ['admin', 'gestor']);

    if (!$isAuthor && !$isAdminOrGestor) {
        abort(403, 'Não tem permissão para modificar esta avaliação.');
    }
}
}