<?php

namespace App\Http\Controllers;

use App\Models\Cultura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CulturaController extends Controller
{
    public function index() {
        $culturas = Cultura::all();
        return view('culturas.index', compact('culturas'));
    }

    public function create() {
        return view('culturas.create');
    }

    public function store(Request $request) {
        // Validar com regras para múltiplos arquivos
        $request->validate([
            'nome'=>'required|string|max:255',
            'tipo'=>'required',
            'descicao'=>'required',
            'localizacao'=>'required',
            'data_celebracao'=>'nullable|date',
            'origem_etnica'=>'required',
            'imagem.*'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:10000' // Aceita múltiplos arquivos
        ]);

        // Criar cultura (sem o campo imagem)
        $cultura = Cultura::create($request->except('imagem'));

        // Upload das múltiplas imagens
        if ($request->hasFile('imagem')) {
            $images = $request->file('imagem');
            
            // Para cada imagem enviada
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $path = $image->store('culturas', 'public');
                    
                    // Salvar no campo foto_capa (apenas a primeira imagem)
                    if (!$cultura->foto_capa) {
                        $cultura->update(['foto_capa' => $path]);
                    }
                    
                    // Se tiver relação de imagens, salvar todas
                    if (method_exists($cultura, 'imagens')) {
                        $cultura->imagens()->create([
                            'imagem' => $path
                        ]);
                    }
                }
            }
        }

        return redirect()->route('culturas.index')->with('success', 'Cultura criada com sucesso!');
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
            'descicao'=>'required',
            'localizacao'=>'required',
            'data_celebracao'=>'nullable|date',
            'origem_etnica'=>'required',
            'imagem.*'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:10000'
        ]);

        $cultura->update($request->except('imagem'));

        if ($request->hasFile('imagem')) {
            $images = $request->file('imagem');
            
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $path = $image->store('culturas', 'public');
                    
                    // Atualizar foto_capa (apenas a primeira nova imagem)
                    if (!$cultura->foto_capa) {
                        // Deletar foto antiga
                        if ($cultura->foto_capa && Storage::disk('public')->exists($cultura->foto_capa)) {
                            Storage::disk('public')->delete($cultura->foto_capa);
                        }
                        $cultura->update(['foto_capa' => $path]);
                    }
                    
                    // Salvar na relação de imagens
                    if (method_exists($cultura, 'imagens')) {
                        $cultura->imagens()->create(['imagem' => $path]);
                    }
                }
            }
        }

        return redirect()->route('culturas.index')->with('success', 'Cultura atualizada com sucesso!');
    }

    public function destroy(Cultura $cultura) {
        // Deletar imagens relacionadas
        if ($cultura->foto_capa && Storage::disk('public')->exists($cultura->foto_capa)) {
            Storage::disk('public')->delete($cultura->foto_capa);
        }
        
        // Deletar múltiplas imagens se existir relação
        if (method_exists($cultura, 'imagens')) {
            foreach ($cultura->imagens as $imagem) {
                if (Storage::disk('public')->exists($imagem->imagem)) {
                    Storage::disk('public')->delete($imagem->imagem);
                }
            }
        }
        
        $cultura->delete();
        return redirect()->route('culturas.index')->with('success', 'Cultura removida com sucesso!');
    }
}