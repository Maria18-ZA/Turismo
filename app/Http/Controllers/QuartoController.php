<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Quarto;
use App\Models\Imagem_Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuartoController extends Controller
{
    /**
     * Apenas utilizadores autenticados podem gerir quartos.
     * showUser é público.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['showUser']);
    }

    /**
     * Listar quartos
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $quartos = Quarto::with(['hotel', 'imagemPrincipal'])->latest()->get();
        } else {
            $quartos = Quarto::whereHas('hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with(['hotel', 'imagemPrincipal'])->latest()->get();
        }

        return view('quartos.index', compact('quartos'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $user = auth()->user();

        $hoteis = ($user->role === 'admin')
            ? Hotel::all()
            : Hotel::where('user_id', $user->id)->get();

        return view('quartos.create', compact('hoteis'));
    }

    /**
     * Guardar quarto
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'  => 'required|exists:hoteis,id',
            'numero'    => 'required|string|max:255',
            'tipo'      => 'required|string|max:255',
            'preco'     => 'required|numeric|min:0',
            'imagens'   => 'nullable|array',
            'imagens.*' => 'image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Segurança para gestor
        if (auth()->user()->role === 'gestor') {
            $hotel = Hotel::where('id', $request->hotel_id)
                ->where('user_id', auth()->id())
                ->first();
            if (!$hotel) {
                abort(403, 'Não autorizado.');
            }
        }

        $quarto = Quarto::create($request->only(['hotel_id', 'numero', 'tipo', 'preco']));

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                if ($imagem && $imagem->isValid()) {
                    $path = $imagem->store('quartos', 'public');
                    $quarto->imagens()->create(['imagem' => $path]);
                }
            }
        }

        return redirect()->route('quartos.index')
            ->with('success', 'Quarto criado!');
    }

    /**
     * Mostrar quarto admin/gestor
     */
    public function show(Quarto $quarto)
    {
        $this->authorizeQuarto($quarto);
        return view('quartos.show', compact('quarto'));
    }

    /**
     * Mostrar quarto público
     */
    public function showUser($id)
    {
        $quarto = Quarto::with(['hotel', 'imagens'])->findOrFail($id);
        return view('user.quartos.show', compact('quarto'));
    }

    /**
     * Formulário de edição
     */
    public function edit(Quarto $quarto)
    {
        $this->authorizeQuarto($quarto);

        $user = auth()->user();
        $hoteis = ($user->role === 'admin')
            ? Hotel::all()
            : Hotel::where('user_id', $user->id)->get();

        return view('quartos.edit', compact('quarto', 'hoteis'));
    }

    /**
     * Atualizar quarto
     */
    public function update(Request $request, Quarto $quarto)
    {
        $this->authorizeQuarto($quarto);

        $request->validate([
            'hotel_id'  => 'required|exists:hoteis,id',
            'numero'    => 'required|string|max:255',
            'tipo'      => 'required|string|max:255',
            'preco'     => 'required|numeric|min:0',
            'imagens'   => 'nullable|array',
            'imagens.*' => 'image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $user = auth()->user();

        $updateData = $request->only(['numero', 'tipo', 'preco']);
        if ($user->role === 'admin') {
            $updateData['hotel_id'] = $request->hotel_id;
        } else {
            $hotel = Hotel::where('id', $request->hotel_id)
                ->where('user_id', $user->id)
                ->first();
            if (!$hotel) {
                abort(403, 'Não autorizado.');
            }
        }

        $quarto->update($updateData);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                if ($imagem && $imagem->isValid()) {
                    $path = $imagem->store('quartos', 'public');
                    $quarto->imagens()->create(['imagem' => $path]);
                }
            }
        }

        return redirect()->route('quartos.index')
            ->with('success', 'Quarto atualizado!');
    }

    /**
     * Eliminar quarto
     */
    public function destroy(Quarto $quarto)
    {
        $this->authorizeQuarto($quarto);

        foreach ($quarto->imagens as $imagem) {
            Storage::disk('public')->delete($imagem->imagem);
        }
        $quarto->delete();

        return redirect()->route('quartos.index')
            ->with('success', 'Quarto removido!');
    }

    /**
     * Eliminar imagem de um quarto
     */
    public function destroyImagem(Quarto $quarto, Imagem_Quarto $imagem)
    {
        // Verifica se a imagem pertence ao quarto
        if ($imagem->quarto_id !== $quarto->id) {
            abort(404);
        }
        $this->authorizeQuarto($quarto);

        $eraPrincipal = $imagem->is_principal;

        Storage::disk('public')->delete($imagem->imagem);
        $imagem->delete();

        // Se era a principal, promove outra imagem
        if ($eraPrincipal) {
            $novaPrincipal = $quarto->imagens()
                ->orderBy('id')
                ->first();

            if ($novaPrincipal) {
                $novaPrincipal->update(['is_principal' => true]);
            }
        }

        return redirect()->route('quartos.edit', $quarto)
            ->with('success', 'Imagem removida.');
    }

    /**
     * Definir imagem principal do quarto
     */
    public function setPrincipal(Quarto $quarto, Imagem_Quarto $imagem)
    {
        if ($imagem->quarto_id !== $quarto->id) {
            abort(404);
        }
        $this->authorizeQuarto($quarto);

        $quarto->imagens()->update(['is_principal' => false]);
        $imagem->update(['is_principal' => true]);

        return redirect()->route('quartos.edit', $quarto)
            ->with('success', 'Imagem principal definida.');
    }

    /**
     * Verificação de permissões (single database)
     */
    private function authorizeQuarto(Quarto $quarto)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return;
        }

        if (!$quarto->hotel || $quarto->hotel->user_id !== $user->id) {
            abort(403, 'Não autorizado.');
        }
    }
}