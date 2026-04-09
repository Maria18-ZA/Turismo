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
            'preco'=>'required|numeric'
        ]);
        $quarto = Quarto::create($request->all());

        ImagemQuarto::create([
            'quarto_id' => $quarto->id,
            'imagem' => $request->imagem
        ]);
        
        return redirect()->route('quartos.index')->with('success','Quarto criado!');
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
            'preco'=>'required|numeric'
        ]);
        $quarto->update($request->all());
        return redirect()->route('quartos.index')->with('success','Quarto atualizado!');
    }

    public function destroy(Quarto $quarto) {
        $quarto->delete();
        return redirect()->route('quartos.index')->with('success','Quarto removido!');
    }
}