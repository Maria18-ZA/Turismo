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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'categoria' => 'required|string|max:255',
            'contato' => 'nullable|string|max:255',
            'imagens' => 'nullable|array',
            'imagens.*' => 'nullable|image|mimes:jpg,jpeg,png|max:10240'
        ]);

        $hoteis = Hotel::create($request->except('imagens'));

        if ($request->hasFile('imagens')) {

            foreach ($request->file('imagens') as $imagem) {

             // 👇 IGNORA campos vazios
        if (!$imagem || !$imagem->isValid()) {
            continue;
        }

            $path = $imagem->store('hoteis', 'public');

            $hoteis->imagens()->create([
                'imagem' => $path
            ]);
        }
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
            'latitude' => 'required',
            'longitude' => 'required',
            'contato' => 'required',

            // MULTIPLAS 👇
            'imagens' => 'nullable|array',
            'imagens.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Atualizar dados do hotel
        $hotel->update($request->only([
            'nome',
            'localizacao',
            'descricao',
            'latitude',
            'longitude',
            'contato',
        ]));

        // 👉 SE FORAM ENVIADAS NOVAS IMAGENS
        if ($request->hasFile('imagens')) {

            foreach ($request->file('imagens') as $imagem) {

                  if (!$imagem || !$imagem->isValid()) {
        continue;
    }

                $path = $imagem->store('hoteis', 'public');

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



