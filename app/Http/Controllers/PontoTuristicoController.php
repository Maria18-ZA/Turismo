<?php

namespace App\Http\Controllers;

use App\Models\PontoTuristico;
use Illuminate\Http\Request;

class PontoTuristicoController extends Controller
{
    public function index()
    {
        $pontos = PontoTuristico::all();
        return view('pontosturisticos.index', compact('pontos'));
    }

    public function create()
    {
        return view('pontosturisticos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'        => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'descricao'   => 'required|string',
            'categoria'   => 'required|string|max:255',
            'contato'     => 'nullable|string|max:255',
        ]);

        PontoTuristico::create($request->all());

        return redirect()
            ->route('pontosturisticos.index')
            ->with('success', 'Ponto turístico criado com sucesso.');
    }

    public function show(PontoTuristico $pontoTuristico)
    {
        return view('pontosturisticos.show', compact('pontoTuristico'));
    }

    public function edit(PontoTuristico $pontoTuristico)
    {
        return view('pontosturisticos.edit', compact('pontoTuristico'));
    }

    public function update(Request $request, PontoTuristico $pontoTuristico)
    {
        $request->validate([
            'nome'        => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'descricao'   => 'required|string',
            'categoria'   => 'required|string|max:255',
            'contato'     => 'nullable|string|max:255',
        ]);

        $pontoTuristico->update($request->all());

        return redirect()
            ->route('pontosturisticos.index')
            ->with('success', 'Ponto turístico atualizado com sucesso.');
    }

    public function destroy(PontoTuristico $pontoTuristico)
    {
        $pontoTuristico->delete();

        return redirect()
            ->route('pontosturisticos.index')
            ->with('success', 'Ponto turístico eliminado com sucesso.');
    }
}