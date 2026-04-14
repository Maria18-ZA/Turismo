<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Hotel;
use App\Models\PontoTuristico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AvaliacaoController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $avaliacoes = Avaliacao::with(['user', 'hotel', 'pontoTuristico'])->get();
        return view('avaliacoes.index', compact('avaliacoes'));
    }

    public function create()
{
    $hoteis = Hotel::all();
    $pontos = PontoTuristico::all();

    return view('avaliacoes.create', compact('hoteis', 'pontos'));
}

    public function store(Request $request)
{
    
    $this->authorize('create', Avaliacao::class);

    $request->validate([
        'hotel_id' => 'nullable|exists:hoteis,id',
        'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
        'estrela' => 'required|integer|min:1|max:5',
        'comentario' => 'nullable|string',
    ]);

    Avaliacao::create([
        'user_id' => auth()->id(),
        'hotel_id' => $request->hotel_id,
        'pontoturistico_id' => $request->pontoturistico_id,
        'estrela' => $request->estrela,
        'comentario' => $request->comentario,
    ]);

    return redirect()->route('avaliacoes.index')
        ->with('success', 'Avaliação criada com sucesso!');
}

    public function show(Avaliacao $avaliacao)
    {
        return view('avaliacoes.show', compact('avaliacao'));
    }

    public function edit(Avaliacao $avaliacao)
    {
        $users = User::all();
        $hoteis = Hotel::all();
        $pontos = PontoTuristico::all();
        return view('avaliacoes.edit', compact('avaliacao', 'users', 'hoteis', 'pontos'));
    }

    public function update(Request $request, Avaliacao $avaliacao)
{
    $this->authorize('update', $avaliacao);

    $request->validate([
        'hotel_id' => 'nullable|exists:hoteis,id',
        'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
        'estrela' => 'required|integer|min:1|max:5',
        'comentario' => 'nullable|string',
    ]);

    $avaliacao->update([
        'hotel_id' => $request->hotel_id,
        'pontoturistico_id' => $request->pontoturistico_id,
        'estrela' => $request->estrela,
        'comentario' => $request->comentario,
    ]);

    return redirect()->route('avaliacoes.index')
        ->with('success', 'Avaliação atualizada com sucesso!');
}

    public function destroy(Avaliacao $avaliacao)
    {
        $this->authorize('delete', $avaliacao);
        $avaliacao->delete();
        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação excluída com sucesso!');
    }
}