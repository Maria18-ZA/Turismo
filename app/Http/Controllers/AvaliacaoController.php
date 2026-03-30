<?php

namespace App\Http\Controllers;


use App\Models\Avaliacao;
use App\Models\Hotel;
use App\Models\PontoTuristico;
use App\Models\User;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacao::with(['user', 'hotel', 'pontoTuristico'])->get();
        return view('avaliacoes.index', compact('avaliacoes'));
    }

    public function create()
    {
        $users = User::all();
        $hoteis = Hotel::all();
        $pontos = PontoTuristico::all();
        return view('avaliacoes.create', compact('users', 'hoteis', 'pontos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'nullable|exists:hoteis,id',
            'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
            'nota' => 'required|integer|min:0|max:5',
            'comentario' => 'nullable|string',
        ]);

        Avaliacao::create($request->all());

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação criada com sucesso!');
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'nullable|exists:hoteis,id',
            'pontoturistico_id' => 'nullable|exists:pontos_turisticos,id',
            'nota' => 'required|integer|min:0|max:5',
            'comentario' => 'nullable|string',
        ]);

        $avaliacao->update($request->all());

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação atualizada com sucesso!');
    }

    public function destroy(Avaliacao $avaliacao)
    {
        $avaliacao->delete();
        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação excluída com sucesso!');
    }
}