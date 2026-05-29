<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Hotel;
use App\Models\PontoTuristico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    /**
     * Todas as ações exigem autenticação.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * LISTAR AVALIAÇÕES
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $avaliacoes = Avaliacao::with(['hotel', 'pontoTuristico'])->latest()->get();
        } elseif ($user->role === 'gestor') {
            $avaliacoes = Avaliacao::whereHas('hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with(['hotel', 'pontoTuristico'])->latest()->get();
        } else { // turista
            $avaliacoes = Avaliacao::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->with(['hotel', 'pontoTuristico'])
                ->latest()
                ->get();
        }

        return view('avaliacoes.index', compact('avaliacoes'));
    }

    /**
     * MOSTRAR
     */
    public function show(Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);
        return view('avaliacoes.show', compact('avaliacao'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $user = auth()->user();

        $hoteis = ($user->role === 'admin')
            ? Hotel::all()
            : Hotel::where('user_id', $user->id)->get();

        $pontos = PontoTuristico::all();

        return view('avaliacoes.create', compact('hoteis', 'pontos'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'           => 'nullable|exists:hoteis,id',
            'pontoturistico_id'  => 'nullable|exists:pontos_turisticos,id',
            'email'              => 'required|email',
            'comentario'         => 'nullable|string|max:1000',
            'nota'               => 'required|integer|min:1|max:5',
        ]);

        if (!$request->hotel_id && !$request->pontoturistico_id) {
            return back()->withErrors(['error' => 'Selecione um hotel ou ponto turístico.'])->withInput();
        }

        $user = auth()->user();

        // Segurança gestor: só pode criar avaliação para hotel que lhe pertence
        if ($user->role === 'gestor' && $request->hotel_id) {
            $hotel = Hotel::where('id', $request->hotel_id)
                ->where('user_id', $user->id)
                ->first();
            if (!$hotel) {
                abort(403, 'Não autorizado.');
            }
        }

        // Evitar duplicação
        $duplicado = Avaliacao::where('email', $request->email)
            ->where(function ($q) use ($request) {
                if ($request->hotel_id) {
                    $q->where('hotel_id', $request->hotel_id);
                }
                if ($request->pontoturistico_id) {
                    $q->where('pontoturistico_id', $request->pontoturistico_id);
                }
            })->exists();

        if ($duplicado) {
            return back()->withErrors(['error' => 'Este email já avaliou este item.'])->withInput();
        }

        $userModel = User::where('email', $request->email)->first();

        Avaliacao::create([
            'user_id'            => $userModel?->id,
            'hotel_id'           => $request->hotel_id,
            'pontoturistico_id'  => $request->pontoturistico_id,
            'email'              => $request->email,
            'comentario'         => $request->comentario,
            'nota'               => $request->nota,
        ]);

        return redirect()->route('avaliacoes.index')
            ->with('success', 'Avaliação criada com sucesso.');
    }

    /**
     * EDIT
     */
    public function edit(Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);

        $user = auth()->user();
        $hoteis = ($user->role === 'admin')
            ? Hotel::all()
            : Hotel::where('user_id', $user->id)->get();

        $pontos = PontoTuristico::all();

        return view('avaliacoes.edit', compact('avaliacao', 'hoteis', 'pontos'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);

        $request->validate([
            'email'      => 'required|email',
            'comentario' => 'nullable|string|max:1000',
            'nota'       => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();

        // Apenas admin pode alterar o hotel/ponto alvo da avaliação
        if ($user->role === 'admin') {
            $request->validate([
                'hotel_id'          => 'nullable|exists:hoteis,id',
                'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
            ]);

            // Verificar duplicação com o novo hotel/ponto
            $exists = Avaliacao::where('email', $request->email)
                ->where(function ($q) use ($request) {
                    if ($request->hotel_id) $q->where('hotel_id', $request->hotel_id);
                    if ($request->pontoturistico_id) $q->where('pontoturistico_id', $request->pontoturistico_id);
                })
                ->where('id', '!=', $avaliacao->id)
                ->exists();

            if ($exists) {
                return back()->withErrors(['error' => 'Já existe uma avaliação deste email para este item.']);
            }

            $avaliacao->update($request->only(['hotel_id', 'pontoturistico_id', 'email', 'comentario', 'nota']));
        } else {
            // Gestor ou turista: não podem mudar hotel/ponto nem o email (apenas comentário e nota)
            $avaliacao->update($request->only(['comentario', 'nota']));
        }

        return redirect()->route('avaliacoes.index')
            ->with('success', 'Avaliação atualizada.');
    }

    /**
     * DELETE
     */
    public function destroy(Avaliacao $avaliacao)
    {
        $this->authorizeAvaliacao($avaliacao);
        $avaliacao->delete();

        return redirect()->route('avaliacoes.index')
            ->with('success', 'Avaliação removida.');
    }

    /**
     * AUTORIZAÇÃO
     */
    private function authorizeAvaliacao(Avaliacao $avaliacao)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return;
        }

        $isOwner = ($avaliacao->user_id === $user->id || $avaliacao->email === $user->email);

        $isHotelOwner = ($avaliacao->hotel && $avaliacao->hotel->user_id === $user->id);

        if (!$isOwner && !$isHotelOwner) {
            abort(403, 'Não autorizado.');
        }
    }
}