<?php

namespace App\Http\Controllers;

use App\Models\Cultura;
use Illuminate\Http\Request;

class CulturaController extends Controller {
    public function index() {
        $culturas = Cultura::all();
        return view('culturas.index', compact('culturas'));
    }

    public function create() {
        $hoteis = Cultura::all();
        return view('culturas.create', compact('culturas'));
    }

    public function store(Request $request) {
        $request->validate([
            'nome'=>'required|exists:culturas,nome',
            'tipo'=>'required',
            'descricao'=>'required',
            'localizacao'=>'required',
            'data_celebracao'=>'required|date',
            'foto_capa'=>'required|url',
            'origem_etnica'=>'required'
        ]);
            $cultura = Cultura::create($request->all());
    
            Imagem_Cultura::create([
                'cultura_id' => $cultura->id,
                'imagem' => $request->imagem
            ]);
        Cultura::create($request->all());
        return redirect()->route('culturas.index')->with('success','Cultura criada!');
    }

    
    public function edit(Cultura $cultura) {
        $hoteis = Cultura::all();
        return view('culturas.edit', compact('cultura','hoteis'));
    }

    public function update(Request $request, Cultura $cultura) {
        $request->validate([
            'nome'=>'required|exists:culturas,nome',
            'tipo'=>'required',
            'descricao'=>'required',
            'localizacao'=>'required',
            'data_celebracao'=>'required|date',
            'foto_capa'=>'required|url',
            'origem_etnica'=>'required'
        ]);
        $cultura->update($request->all());
        return redirect()->route('culturas.index')->with('success','Cultura atualizada!');
    }

    public function destroy(Cultura $cultura) {
        $cultura->delete();
        return redirect()->route('culturas.index')->with('success','Cultura removida!');
    }
}