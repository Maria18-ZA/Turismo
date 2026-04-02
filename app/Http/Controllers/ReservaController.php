<?php

namespace App\Http\Controllers;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Quarto;
use App\Models\Hotel;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use App\Models\Quarto;
use Illuminate\Http\Request;

class ReservaController extends Controller {

    public function index() {
        $reservas = Reserva::with(['user','quarto'])->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create() {
        $users = User::all();
        $quartos = Quarto::all();

        return view('reservas.create', compact('users', 'quartos'));
    }

public function store(Request $request)
{
    $request->validate([
        'quarto_id' => 'required|exists:quartos,id',
        'checkin' => 'required|date',
        'checkout' => 'required|date|after:checkin',
    ]);

    Reserva::create([
        'user_id' => auth()->id(),  // pega usuário logado
        'quarto_id' => $request->quarto_id,
        'checkin' => $request->checkin,
        'checkout' => $request->checkout,
    ]);

    return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
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
}