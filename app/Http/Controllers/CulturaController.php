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
        $culturas = Cultura::all();
        return view('culturas.create', compact('culturas'));
    }

   
    public function store(Request $request) {
    $request->validate([
        'nome'=>'required|string|max:255',
        'tipo'=>'required',
        'descricao'=>'required',
        'localizacao'=>'required',
        'data_celebracao'=>'nullable|date',
        'foto_capa'=>'nullable|max:10000',
        'origem_etnica'=>'required',
        'imagem'=>'nullable|max:10000'
    ]);

    // Criar cultura
    $cultura = Cultura::create($request->all());

    // Upload da imagem
    if ($request->hasFile('imagem')) {
        $path = $request->file('imagem')->store('culturas', 'public');

        $cultura->imagens()->create([
            'imagem' => $path
        ]);
    }

    return redirect()->route('culturas.index')->with('success','Cultura criada!');
}

 public function show(Cultura $cultura)
    {
        return view('culturas.show', compact('cultura'));
    }
    public function edit(Cultura $cultura) {
        return view('culturas.edit', compact('cultura'));
    }

    public function update(Request $request, Cultura $cultura) {
    $request->validate([
        'nome'=>'required|string|max:255',
        'tipo'=>'required',
        'descricao'=>'required',
        'localizacao'=>'required',
        'data_celebracao'=>'nullable|date',
        'foto_capa'=>'nullable|max:10000',
        'origem_etnica'=>'required',
        'imagem'=>'nullable|max:10000'
    ]);

    $cultura->update($request->all());

    if ($request->hasFile('imagem')) {

        $path = $request->file('imagem')->store('culturas', 'public');

        $imagem = $cultura->imagens()->first();

        if ($imagem) {
            Storage::disk('public')->delete($imagem->imagem);

            $imagem->update([
                'imagem' => $path
            ]);
        } else {
            $cultura->imagens()->create([
                'imagem' => $path
            ]);
        }
    }

    return redirect()->route('culturas.index')->with('success','Cultura atualizada!');
}

    public function destroy(Cultura $cultura) {
        $cultura->delete();
        return redirect()->route('culturas.index')->with('success','Cultura removida!');
    }
}