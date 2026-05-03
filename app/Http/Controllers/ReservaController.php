<?php

namespace App\Http\Controllers;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Quarto;
use App\Models\Hotel;
 use Carbon\Carbon;
use Illuminate\Http\Request;


class ReservaController extends Controller {

    public function index() {
        $reservas = Reserva::with(['user','quartos'])->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create() {
        $users = User::all();
        $quartos = Quarto::all();

        return view('reservas.create', compact('users', 'quartos'));
    }

   
public function store(Request $request)
{
    $this->authorize('create', Reserva::class);

    // 🔍 1. VALIDAÇÃO
    $request->validate([
        'nome_user' => 'required|string|max:255',
        'checkin' => 'required|date',
        'checkout' => 'required|date|after:checkin',

        'quarto_id' => 'nullable|exists:quartos,id',
        'quartos' => 'nullable|array',
        'quartos.*.quarto_id' => 'required_with:quartos|exists:quartos,id',
        'quartos.*.quantidade' => 'nullable|integer|min:1',
    ]);

    // 🔍 2. DEFINIR TIPO DE RESERVA
    $isMultipla = $request->has('quartos');

    // 🧱 3. CRIAR RESERVA
    $reserva = Reserva::create([
        'user_id' => auth()->id(),
        'nome_user' => $request->nome_user,
        'tipo_reserva' => $isMultipla ? 'multipla' : 'simples',
        'preco_total' => 0,
        'checkin' => $request->checkin,
        'checkout' => $request->checkout,
        'status' => 'pendente'
    ]);

    // 🧮 4. CALCULAR DIAS
    $dias = Carbon::parse($request->checkin)
        ->diffInDays(Carbon::parse($request->checkout));

    $total = 0;

    // 🟢 5. RESERVA SIMPLES
    if (!$isMultipla && $request->filled('quarto_id')) {

        $quarto = Quarto::findOrFail($request->quarto_id);

        $subtotal = $dias * $quarto->preco;

        $reserva->quartos()->attach($quarto->id, [
            'quantidade' => 1,
            'preco' => $quarto->preco
        ]);

        $total += $subtotal;
    }

    // 🔵 6. RESERVA MÚLTIPLA
    if ($isMultipla) {

        foreach ($request->quartos as $q) {

            $quarto = Quarto::findOrFail($q['quarto_id']);
            $quantidade = $q['quantidade'] ?? 1;

            $subtotal = $dias * $quarto->preco * $quantidade;

            $reserva->quartos()->attach($quarto->id, [
                'quantidade' => $quantidade,
                'preco' => $quarto->preco
            ]);

            $total += $subtotal;
        }
    }

    // 💰 7. GUARDAR PREÇO TOTAL
    $reserva->update([
        'preco_total' => $total
    ]);

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva criada com sucesso!');
}
    public function edit(Reserva $reserva) {
        $users = User::all();
        $quartos = Quarto::all();

        return view('reservas.edit', compact('reserva','users','quartos'));
    }

    public function update(Request $request, Reserva $reserva) {
    $request->validate([
        'nome_user' => 'required|string|max:255',
        'quarto_id' => 'required|exists:quartos,id',
        'checkin' => 'required|date',
        'checkout' => 'required|date|after:checkin',
    ]);

    // 1. Calcular novo preço
    $quarto = Quarto::findOrFail($request->quarto_id);
    $dias = Carbon::parse($request->checkin)->diffInDays(Carbon::parse($request->checkout));
    $total = $dias * $quarto->preco;

    // 2. Atualizar a reserva
    $reserva->update([
        'nome_user' => $request->nome_user,
        'checkin' => $request->checkin,
        'checkout' => $request->checkout,
        'preco_total' => $total,
        'quarto_id' => $request->quarto_id // Mantendo sincronia com a coluna da tabela reservas
    ]);

    // 3. Sincronizar na tabela pivô (reserva_quartos)
    $reserva->quartos()->sync([
        $request->quarto_id => ['quantidade' => 1, 'preco' => $quarto->preco]
    ]);

    return redirect()->route('reservas.index')->with('success','Reserva atualizada!');
}
    public function destroy(Reserva $reserva) {
        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success','Reserva removida!');
    }
}