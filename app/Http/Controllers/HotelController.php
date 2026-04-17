<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HotelController extends Controller
{
    public function index()
    {
        $hoteis = Hotel::all();
        return view('hoteis.index', compact('hoteis'));
    }

    public function create()
    {
        return view('hoteis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'descricao' => 'required|string',
            'categoria' => 'required|string|max:255',
            'contato' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $hoteis = Hotel::create($request->all());

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('hoteis', 'public');

            $hoteis->imagens()->create([
                'imagem' => $path
            ]);
        }

        return redirect()
            ->route('hoteis.index')
            ->with('success', 'Hotel criado com sucesso.');
    }

    //Admin 
    public function show(Hotel $hotel)
    {
        return view('hoteis.show', compact('hotel'));
    }

    //User
    public function showUser($id)
{
    $hotel = Hotel::with(['quartos', 'servicos'])->findOrFail($id);

    return view('user.hoteis.show', compact('hotel'));
}

    public function edit(Hotel $hotel)
    {
        return view('hoteis.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nome' => 'required',
            'localizacao' => 'required',
            'descricao' => 'required',
            'contato' => 'required',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Atualizar dados do hotel
        $hotel->update($request->all());

        // Verificar se foi enviada uma nova imagem
        if ($request->hasFile('imagem')) {

            // Guardar nova imagem
            $path = $request->file('imagem')->store('hoteis', 'public');

            // Buscar imagem existente
            $imagem = $hotel->imagens()->first();

            if ($imagem) {
                // Apagar imagem antiga
                Storage::disk('public')->delete($imagem->imagem);

                // Atualizar no banco
                $imagem->update([
                    'imagem' => $path
                ]);
            } else {
                // Criar nova imagem
                $hotel->imagens()->create([
                    'imagem' => $path
                ]);
            }
        }

        return redirect()
            ->route('hoteis.index')
            ->with('success', 'Hotel atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()
            ->route('hoteis.index')
            ->with('success', 'Hotel deletado com sucesso.');
    }
}



