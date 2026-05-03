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
     if (!auth()->check()) {
        abort(403, 'Precisa de estar autenticado para criar uma reserva.');
    }
    $request->validate([
        'nome_user' => 'required|string|max:255',
        'checkin'   => 'required|date',
        'checkout'  => 'required|date|after:checkin',
        'quartos'   => 'required|array',
    ]);

    // Verifica se pelo menos um quarto foi selecionado
    $quartosSelecionados = collect($request->quartos)
        ->filter(fn($q) => isset($q['ativo']))
        ->filter(fn($q) => ($q['quantidade'] ?? 1) > 0);

    if ($quartosSelecionados->isEmpty()) {
        return back()->withErrors(['quartos' => 'Selecione pelo menos um quarto.'])->withInput();
    }

    $dias = Carbon::parse($request->checkin)->diffInDays(Carbon::parse($request->checkout));
    if ($dias == 0) $dias = 1; // pelo menos 1 diária

    $total = 0;

    $reserva = Reserva::create([
        'user_id'      => auth()->id(),
        'nome_user'    => $request->nome_user,
        'tipo_reserva' => $quartosSelecionados->count() > 1 ? 'multipla' : 'simples',
        'preco_total'  => 0,
        'checkin'      => $request->checkin,
        'checkout'     => $request->checkout,
        'status'       => 'pendente',
    ]);

    foreach ($quartosSelecionados as $quartoId => $dados) {
        $quarto = Quarto::findOrFail($quartoId);
        $quantidade = (int) ($dados['quantidade'] ?? 1);
        $subtotal = $dias * $quarto->preco * $quantidade;

        $reserva->quartos()->attach($quarto->id, [
            'quantidade' => $quantidade,
            'preco'      => $quarto->preco,
        ]);

        $total += $subtotal;
    }

    $reserva->update(['preco_total' => $total]);

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva criada com sucesso!');
}
   
public function show(Reserva $reserva)
{
    $reserva->load('quartos');
    return view('reservas.show', compact('reserva'));
}

    public function edit(Reserva $reserva) {
        $users = User::all();
        $quartos = Quarto::all();

        return view('reservas.edit', compact('reserva','users','quartos'));
    }

    public function update(Request $request, Reserva $reserva) {
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'quarto_id'=>'required|exists:quartos,id',
            'checkin'=>'required|date',
            'checkout'=>'required|date|after:checkin',
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')
            ->with('success','Reserva atualizada!');
    }

    public function destroy(Reserva $reserva) {
        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success','Reserva removida!');
    }


    public function confirm(Reserva $reserva)
{
    if (!auth()->user()?->is_admin) {
    abort(403, 'Acesso não autorizado.');
}
    #$this->authorize('update', $reserva);
    $reserva->update(['status' => 'confirmada']);
    return redirect()->route('reservas.index')->with('success', 'Reserva confirmada.');
}

public function cancel(Reserva $reserva)
{
    if (!auth()->user()?->is_admin) {
    abort(403, 'Acesso não autorizado.');
}
    #$this->authorize('update', $reserva);
    $reserva->update(['status' => 'cancelada']);
    return redirect()->route('reservas.index')->with('success', 'Reserva cancelada.');
}
    
 }