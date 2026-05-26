<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $hoteis = Hotel::all();
        return view('servicos.index', compact('hoteis'));
    }

   public function create()
{
    $hoteis = Hotel::all();

    $servicosExistentes = Servico::select('nome')->distinct()->get();

    return view(
        'servicos.create',compact('hoteis', 'servicosExistentes')
    );
}

   public function store(Request $request)
{
    $request->validate([
        'hotel_id' => 'required|exists:hoteis,id',
    ]);

    // Serviços selecionados
    if($request->servicos){

        foreach($request->servicos as $servicoNome){

            Servico::create([
                'hotel_id'  => $request->hotel_id,
                'nome'      => $servicoNome,
                'categoria' => 'Hotel',
            ]);
        }
    }

    // Novos serviços digitados
if($request->novo_servico){

    // separa pelos nomes usando vírgula
    $novosServicos = explode(',', $request->novo_servico);

    foreach($novosServicos as $novoServico){

        $nome = trim($novoServico);

        if($nome != ''){

            Servico::create([
                'hotel_id'  => $request->hotel_id,
                'nome'      => $nome,
                'categoria' => 'Hotel',
            ]);
        }
    }
}
    return redirect()
        ->route('servicos.index')
        ->with('success', 'Serviços criados com sucesso.');
}
    public function show(Servico $servico) //era $servicos
    {
        return view('servicos.show', compact('servico')); 
    }

    public function edit(Servico $servico) 
    {
        return view('servicos.edit', compact('servico')); 
    }

    public function update(Request $request, Servico $servico) 
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        $servico->update($request->all());

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Servico $servico) 
    {
        $servico->delete();

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço eliminado com sucesso.');
    }
}