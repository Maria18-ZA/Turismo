<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\ImagemHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Apenas utilizadores autenticados podem gerir hotéis.
     * O método showUser é público.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['showUser']);
    }

    /**
     * LISTAR HOTEIS
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $hoteis = Hotel::latest()->get();
        } else {
            $hoteis = Hotel::where('user_id', $user->id)->latest()->get();
        }

        return view('hoteis.index', compact('hoteis'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('hoteis.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'        => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'descricao'   => 'required|string',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'categoria'   => 'required|string|max:255',
            'contato'     => 'nullable|string|max:255',
            'imagens'     => 'nullable|array',
            'imagens.*'   => 'image|mimes:jpeg,png,jpg|max:10000', // corrigido
        ]);

        $hotel = Hotel::create([
            'user_id'     => auth()->id(),
            'nome'        => $request->nome,
            'localizacao' => $request->localizacao,
            'descricao'   => $request->descricao,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'categoria'   => $request->categoria,
            'contato'     => $request->contato,
        ]);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                if ($imagem && $imagem->isValid()) {
                    $path = $imagem->store('hoteis', 'public');
                    $hotel->imagens()->create(['imagem' => $path]);
                }
            }
        }

        return redirect()->route('hoteis.index')
            ->with('success', 'Hotel criado com sucesso.');
    }

    /**
     * SHOW (ADMIN / GESTOR)
     */
    public function show(Hotel $hotel)
    {
        $this->authorizeHotel($hotel);
        return view('hoteis.show', compact('hotel'));
    }

    /**
     * SHOW PUBLIC
     */
    public function showUser($id)
    {
        $hotel = Hotel::with(['quartos', 'servicos', 'imagens'])->findOrFail($id);
        return view('user.hoteis.show', compact('hotel'));
    }

    /**
     * EDIT
     */
    public function edit(Hotel $hotel)
    {
        $this->authorizeHotel($hotel);
        return view('hoteis.edit', compact('hotel'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Hotel $hotel)
    {
        $this->authorizeHotel($hotel);

        $request->validate([
            'nome'        => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'descricao'   => 'required|string',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'categoria'   => 'required|string|max:255',  // adicionado
            'contato'     => 'nullable|string|max:255',
            'imagens'     => 'nullable|array',
            'imagens.*'   => 'image|mimes:jpeg,png,jpg|max:10000', // corrigido
        ]);

        $hotel->update([
            'nome'        => $request->nome,
            'localizacao' => $request->localizacao,
            'descricao'   => $request->descricao,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'categoria'   => $request->categoria,   // adicionado
            'contato'     => $request->contato,
        ]);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                if ($imagem && $imagem->isValid()) {
                    $path = $imagem->store('hoteis', 'public');
                    $hotel->imagens()->create(['imagem' => $path]);
                }
            }
        }

        return redirect()->route('hoteis.index')
            ->with('success', 'Hotel atualizado com sucesso.');
    }

    /**
     * DELETE
     */
    public function destroy(Hotel $hotel)
    {
        $this->authorizeHotel($hotel);

        foreach ($hotel->imagens as $imagem) {
            Storage::disk('public')->delete($imagem->imagem);
        }
        $hotel->delete();

        return redirect()->route('hoteis.index')
            ->with('success', 'Hotel removido com sucesso.');
    }

    /**
     * AUTORIZAÇÃO SINGLE DATABASE
     */
    private function authorizeHotel(Hotel $hotel)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return;
        }

        if ($hotel->user_id !== $user->id) {
            abort(403, 'Não autorizado.');
        }
    }
public function destroyImagem(Hotel $hotel, ImagemHotel $imagem)
{
    // Verifica se a imagem pertence ao hotel
    if ($imagem->hotel_id !== $hotel->id) {
        abort(404);
    }
    $this->authorizeHotel($hotel); // reutiliza a sua autorização

    // Apagar o ficheiro físico
    Storage::disk('public')->delete($imagem->imagem);
    $imagem->delete();

    return redirect()->route('hoteis.edit', $hotel)
        ->with('success', 'Imagem removida.');
}

public function setPrincipal(Hotel $hotel, ImagemHotel $imagem)
{
    if ($imagem->hotel_id !== $hotel->id) {
        abort(404);
    }
    $this->authorizeHotel($hotel);

    // Remove principal de todas as imagens do hotel
    $hotel->imagens()->update(['is_principal' => false]);
    // Marca esta como principal
    $imagem->update(['is_principal' => true]);

    return redirect()->route('hoteis.edit', $hotel)
        ->with('success', 'Imagem principal definida.');
}
 }