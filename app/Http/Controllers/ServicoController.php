<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();
        return view('servicos.index', compact('servicos')); // ← era 'servico', faltava o 's'
    }

    public function create()
    {
      $hoteis = Hotel::all();
        return view('servicos.create', compact('hoteis')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo'      => 'required|string|max:255',
            'hotel_id'  => 'required|exists:hoteis,id',
        ]);

        Servico::create($request->all());

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço criado com sucesso.');
    }

    public function show(Servico $servico) // ← era $servicos
    {
        return view('servicos.show', compact('servico')); // ← era $servicos
    }

    public function edit(Servico $servico) // ← era $servicos
    {
        return view('servicos.edit', compact('servico')); // ← era $servicos
    }

    public function update(Request $request, Servico $servico) // ← era $servicos
    {
        $request->validate([
            'hotel_id'  => 'required|exists:hoteis,id',
            'nome'      => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo'      => 'required|string|max:255',
        ]);

        $servico->update($request->all());

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Servico $servico) // ← era $servicos
    {
        $servico->delete();

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço eliminado com sucesso.');
    }
}