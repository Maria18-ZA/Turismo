<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Avaliacao;
use App\Models\Quarto;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{
     
   public function indexUser()
{
     $search = $request->input('search');

    $hoteis = Hotel::when($search, function ($query, $search) {
        return $query->where('nome', 'like', "%{$search}%")
                     ->orWhere('localizacao', 'like', "%{$search}%");
                    
    })->get();

    return view('user.hoteis.index', compact('hoteis'));

    
}

   public function showUser($id)
{
    $hotel = Hotel::with(['quartos', 'servicos', 'avaliacoes'])->findOrFail($id);

    return view('user.hoteis.show', compact('hotel'));
}

 public function showQuarto($id)
{
    $quarto = Quarto::findOrFail($id);

    return view('user.quartos.show', compact('quarto'));
}

 public function create() {
        $users = User::all();
        $quartos = Quarto::all();

        return view('user.reservas.create', compact('users', 'quartos'));
    }

}
