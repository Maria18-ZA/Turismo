<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use App\Models\Hotel;
use Illuminate\Http\Request;

class QuartoController extends Controller {
    public function index() {
        $quartos = Quarto::all();
        return view('quartos.index', compact('quartos'));
    }

    public function create() {
        $hoteis = Hotel::all();
        return view('quartos.create', compact('hoteis'));
    }

   public function store(Request $request) {
    $request->validate([
        'hotel_id'=>'required|exists:hoteis,id',
        'numero'=>'required',
        'tipo'=>'required',
        'preco'=>'required|numeric',
        'imagem'=>'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Criar quarto
    $quarto = Quarto::create($request->all());

    // Upload da imagem
    if ($request->hasFile('imagem')) {
        $path = $request->file('imagem')->store('quartos', 'public');

        $quarto->imagens()->create([
            'imagem' => $path
        ]);
        
    }

    return redirect()->route('quartos.index')->with('success','Quarto criado!');
}

 public function show(Quarto $quarto)
    {
        return view('quartos.show', compact('quarto'));
    }

    public function edit(Quarto $quarto) {
        $hoteis = Hotel::all();
        return view('quartos.edit', compact('quarto','hoteis'));
    }

   public function update(Request $request, Quarto $quarto) {
    $request->validate([
        'hotel_id'=>'required|exists:hoteis,id',
        'numero'=>'required',
        'tipo'=>'required',
        'preco'=>'required|numeric',
        'imagem'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Atualizar dados
    $quarto->update($request->all());
 

    // Se enviar nova imagem
    if ($request->hasFile('imagem')) {

        $path = $request->file('imagem')->store('quartos', 'public');

        $imagem = $quarto->imagens()->first();

        if ($imagem) {
            Storage::disk('public')->delete($imagem->imagem);

            $imagem->update([
                'imagem' => $path
            ]);
        } else {
            $quarto->imagens()->create([
                'imagem' => $path
            ]);
        }
    }

    return redirect()->route('quartos.index')->with('success','Quarto atualizado!');
}

    public function destroy(Quarto $quarto) {
        $quarto->delete();
        return redirect()->route('quartos.index')->with('success','Quarto removido!');
    }
}