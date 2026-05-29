<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $servicos = Servico::with('hotel')->latest()->get();
            $hoteis   = Hotel::all();
        } else {
            $hoteis = Hotel::where('user_id', $user->id)->get();
            $servicos = Servico::whereHas('hotel', fn($q) => $q->where('user_id', $user->id))
                ->with('hotel')->latest()->get();
        }

        return view('servicos.index', compact('servicos', 'hoteis'));
    }

    public function create()
    {
        $user = auth()->user();
        $hoteis = $user->role === 'admin'
            ? Hotel::all()
            : Hotel::where('user_id', $user->id)->get();

        $servicosExistentes = Servico::select('nome')->distinct()->pluck('nome');
        return view('servicos.create', compact('hoteis', 'servicosExistentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'     => 'required|exists:hoteis,id',
            'servicos'     => 'nullable|array',
            'novo_servico' => 'nullable|string',
        ]);

        $user = auth()->user();
        if ($user->role !== 'admin') {
            $hotel = Hotel::where('id', $request->hotel_id)
                ->where('user_id', $user->id)
                ->first();
            if (!$hotel) abort(403, 'Não autorizado.');
        }

        $hotelId = $request->hotel_id;

        if ($request->servicos) {
            foreach ($request->servicos as $nome) {
                if ($nome) {
                    Servico::firstOrCreate([
                        'hotel_id' => $hotelId,
                        'nome'     => $nome,
                    ], ['categoria' => 'Hotel']);
                }
            }
        }

        if ($request->novo_servico) {
            $novos = explode(',', $request->novo_servico);
            foreach ($novos as $nome) {
                $nome = trim($nome);
                if ($nome) {
                    Servico::firstOrCreate([
                        'hotel_id' => $hotelId,
                        'nome'     => $nome,
                    ], ['categoria' => 'Hotel']);
                }
            }
        }

        return redirect()->route('servicos.index')->with('success', 'Serviços atualizados.');
    }

    public function show(Servico $servico)
    {
        $this->authorizeServico($servico);
        return view('servicos.show', compact('servico'));
    }

    public function edit(Servico $servico)
    {
        $this->authorizeServico($servico);
        return view('servicos.edit', compact('servico'));
    }

    public function update(Request $request, Servico $servico)
    {
        $this->authorizeServico($servico);

        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('servicos')->where('hotel_id', $servico->hotel_id)->ignore($servico->id),
            ],
        ]);

        $servico->update(['nome' => $request->nome]);
        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado.');
    }

    public function destroy(Servico $servico)
    {
        $this->authorizeServico($servico);
        $servico->delete();
        return redirect()->route('servicos.index')->with('success', 'Serviço eliminado.');
    }

    private function authorizeServico(Servico $servico)
    {
        $user = auth()->user();
        if ($user->role === 'admin') return;
        if (!$servico->hotel || $servico->hotel->user_id !== $user->id) {
            abort(403, 'Não autorizado.');
        }
    }
}