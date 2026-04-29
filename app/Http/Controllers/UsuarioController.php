<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Avaliacao;
use App\Models\Quarto;
use App\Models\Reserva;
use App\Models\PontoTuristico;
use App\Models\Cultura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{
     
   public function indexUser(Request $request)
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

     public function indexPontos()
    {
        $pontos = PontoTuristico::all();
        return view('user.pontosturisticos.index', compact('pontos'));
    }

    public function showPontos(PontoTuristico $pontoTuristico)
    {
        return view('user.pontosturisticos.show', compact('pontoTuristico'));
    }

    public function indexCultura() {
        $culturas = Cultura::all();
        return view('user.culturas.index', compact('culturas'));
    }

   
}
