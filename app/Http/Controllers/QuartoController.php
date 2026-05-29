<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Quarto;
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
            $quartos = Quarto::with('hotel')->latest()->get();
        } else {
            $quartos = Quarto::whereHas('hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('hotel')->latest()->get();
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
            'hotel_id' => 'required|exists:hoteis,id',
            'numero'   => 'required|string|max:255',
            'tipo'     => 'required|string|max:255',
            'preco'    => 'required|numeric|min:0',
            'imagem'   => 'required|image|mimes:jpeg,png,jpg|max:10000',
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

        // Criar quarto (apenas campos permitidos)
        $quarto = Quarto::create($request->only(['hotel_id', 'numero', 'tipo', 'preco']));

        // Upload imagem
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('quartos', 'public');
            $quarto->imagens()->create(['imagem' => $path]);
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
            'hotel_id' => 'required|exists:hoteis,id',
            'numero'   => 'required|string|max:255',
            'tipo'     => 'required|string|max:255',
            'preco'    => 'required|numeric|min:0',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $user = auth()->user();

        // Gestor não pode alterar o hotel_id do quarto (apenas admin)
        $updateData = $request->only(['numero', 'tipo', 'preco']);
        if ($user->role === 'admin') {
            $updateData['hotel_id'] = $request->hotel_id;
        } else {
            // Gestor: verificar se o hotel_id pertence ao gestor (segurança extra)
            $hotel = Hotel::where('id', $request->hotel_id)
                ->where('user_id', $user->id)
                ->first();
            if (!$hotel) {
                abort(403, 'Não autorizado.');
            }
            // Mantém o hotel_id original, não altera
        }

        $quarto->update($updateData);

        // Atualizar imagem
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('quartos', 'public');
            $imagem = $quarto->imagens()->first();
            if ($imagem) {
                Storage::disk('public')->delete($imagem->imagem);
                $imagem->update(['imagem' => $path]);
            } else {
                $quarto->imagens()->create(['imagem' => $path]);
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
            $imagem->delete();
        }
        $quarto->delete();

        return redirect()->route('quartos.index')
            ->with('success', 'Quarto removido!');
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

        // Gestor: o quarto deve pertencer a um hotel que ele gere
        if (!$quarto->hotel || $quarto->hotel->user_id !== $user->id) {
            abort(403, 'Não autorizado.');
        }
    }
}