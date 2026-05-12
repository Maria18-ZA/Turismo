<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use App\Models\Quarto;
use App\Models\Hotel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ReservaCriadaMail;

use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{

    public function index()
    {
        $reservas = Reserva::with(['user','quartos'])->get();

        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $users = User::all();
        $quartos = Quarto::all();

        return view('reservas.create', compact('users', 'quartos'));
    }



public function store(Request $request)
{
    // 1. Validação
    $request->validate([
        'nome_user' => 'required|string|max:255',
        'contato' => 'required',
        'email'     => 'required|email', // força unicidade
        'checkin'   => 'required|date',
        'checkout'  => 'required|date|after:checkin',
        'quartos'   => 'required|array',
    ]);

    // 2. Filtrar quartos selecionados (igual ao seu código)
    $quartosSelecionados = collect($request->quartos)
        ->filter(fn($q) => isset($q['ativo']))
        ->filter(fn($q) => ($q['quantidade'] ?? 1) > 0);

    if ($quartosSelecionados->isEmpty()) {
        return back()->withErrors(['quartos' => 'Selecione pelo menos um quarto.'])->withInput();
    }

    // 3. Criar ou obter utilizador (neste caso, como validamos unique, será sempre criado se não existir)
    // Mas para garantir, usamos firstOrCreate (evita duplicados caso validação não seja suficiente)
    $user = User::firstOrCreate(
        ['email' => $request->email],
        [
            'name'     => $request->nome_user,
            'contato' => $request->contato,
            'password' => Hash::make(Str::random(16)), // senha aleatória
            'role'     => 'turista', // explícito
        ]
    );

    // Se o user já existia mas o nome veio diferente, pode atualizar? Fica a seu critério.
    // Exemplo:
    if ($user->wasRecentlyCreated === false && $user->name !== $request->nome_user) {
        $user->update(['name' => $request->nome_user]);
    }

    // 4. Calcular dias
    $dias = Carbon::parse($request->checkin)->diffInDays(Carbon::parse($request->checkout));
    if ($dias == 0) $dias = 1; // (opcional, mas validação after já impede zero)

    $total = 0;

    // 5. Criar reserva associada ao user
    $reserva = Reserva::create([
        'user_id'      => $user->id,
        'nome_user'    => $request->nome_user,
         'contato' => $request->contato,
        'email'    => $request->email, // redundante, mas pode manter
        'tipo_reserva' => $quartosSelecionados->count() > 1 ? 'multipla' : 'simples',
        'preco_total'  => 0,
        'checkin'      => $request->checkin,
        'checkout'     => $request->checkout,
        'status'       => 'pendente',
    ]);
    //validar a variavel
     $hotel = null; // ← Criar a variável aqui
    // 6. Anexar quartos e calcular total
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
    $reserva->quarto = $quarto;

     if ($hotel === null && $quarto->hotel) {
            $hotel = $quarto->hotel; // ← Agora $hotel recebe um valor
        }
    
     // Gerar link do Google Maps se tiver coordenadas
     // 7. Preparar link do Google Maps
         $googleMapsLink = null;
    if ($hotel && $hotel->latitude && $hotel->longitude) {
        $googleMapsLink = "https://www.google.com/maps?q={$hotel->latitude},{$hotel->longitude}";
         }
    // 7. Envio de emails
    \Log::info("dados da reserva: " . $reserva);
    Mail::to($user->email)->send(new ReservaCriadaMail($reserva, $googleMapsLink, $hotel));

    return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
}

    public function show(Reserva $reserva)
    {
        $reserva->load('quartos');

        return view('reservas.show', compact('reserva'));
    }

    public function edit(Reserva $reserva)
    {
        $users = User::all();
        $quartos = Quarto::all();

        return view('reservas.edit', compact('reserva', 'users', 'quartos'));
    }

    public function update(Request $request, Reserva $reserva)
    {

        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'email'    => 'required|email',
            'quarto_id' => 'required|exists:quartos,id',
            'checkin'   => 'required|date',
            'checkout'  => 'required|date|after:checkin',
        ]);

        $reserva->update($request->all());

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva atualizada!');
    }

    public function destroy(Reserva $reserva)
    {

        $reserva->delete();

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva removida!');
    }

    public function confirm(Reserva $reserva)
    {

        if (
            !auth()->check() ||
            !in_array(auth()->user()->role, ['admin', 'gestor'])
        ) {
            abort(403);
        }

        $reserva->update([
            'status' => 'confirmada'
        ]);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva confirmada.');
    }

    public function cancel(Reserva $reserva)
    {

        if (
            !auth()->check() ||
            !in_array(auth()->user()->role, ['admin', 'gestor'])
        ) {
            abort(403);
        }

        $reserva->update([
            'status' => 'cancelada'
        ]);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva cancelada.');
    }
}