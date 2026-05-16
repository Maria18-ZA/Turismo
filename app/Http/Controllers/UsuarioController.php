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

    /**
 * Display the specified cultura.
 */
public function showCulturas(Cultura $culturas)
{
    return view('user.culturas.show', compact('culturas'));
}


    public function createHotelUser(Hotel $hotel)
    {
        return view('user.avaliacoes.hotel', compact('hotel'));
    }

    public function storeHotelUser(Request $request, Hotel $hotel)
    {
        $request->validate([
            'email'      => 'required|email',
            'comentario' => 'nullable|string|max:1000',
            'nota'       => 'required|integer|min:1|max:5',
        ]);

        // Procurar utilizador pelo email
        $user = User::where('email', $request->email)->first();

        // Procurar avaliação existente
        $avaliacao = Avaliacao::where('email', $request->email)
            ->where('hotel_id', $hotel->id)
            ->first();

        // Se já existe -> actualizar
        if ($avaliacao) {

            $avaliacao->update([
                'comentario' => $request->comentario,
                'nota'       => $request->nota,
            ]);

            return redirect()
                ->route('user.hoteis.show', $hotel->id)
                ->with('success', 'Avaliação actualizada com sucesso!');
        }

        // Se não existe -> criar
        Avaliacao::create([
            'user_id'    => $user?->id,
            'hotel_id'   => $hotel->id,
            'email'      => $request->email,
            'comentario' => $request->comentario,
            'nota'       => $request->nota,
        ]);

        return redirect()
            ->route('user.hoteis.show', $hotel->id)
            ->with('success', 'Avaliação enviada com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | PONTO TURÍSTICO
    |--------------------------------------------------------------------------
    */

    public function createPontoUser(PontoTuristico $ponto)
    {
        return view('user.avaliacoes.ponto', compact('ponto'));
    }

    public function storePontoUser(Request $request, PontoTuristico $ponto)
    {
        $request->validate([
            'email'      => 'required|email',
            'comentario' => 'nullable|string|max:1000',
            'nota'       => 'required|integer|min:1|max:5',
        ]);

        // Procurar utilizador pelo email
        $user = User::where('email', $request->email)->first();

        // Procurar avaliação existente
        $avaliacao = Avaliacao::where('email', $request->email)
            ->where('pontoturistico_id', $ponto->id)
            ->first();

        // Se já existe -> actualizar
        if ($avaliacao) {

            $avaliacao->update([
                'comentario' => $request->comentario,
                'nota'       => $request->nota,
            ]);

            return redirect()
                ->route('user.pontosturisticos.show', $ponto->id)
                ->with('success', 'Avaliação actualizada com sucesso!');
        }

        // Se não existe -> criar
        Avaliacao::create([
            'user_id'           => $user?->id,
            'pontoturistico_id' => $ponto->id,
            'email'             => $request->email,
            'comentario'        => $request->comentario,
            'nota'              => $request->nota,
        ]);

        return redirect()
            ->route('user.pontosturisticos.show', $ponto->id)
            ->with('success', 'Avaliação enviada com sucesso!');
    }

   
}
