<?php

namespace App\Http\Controllers;

use App\Mail\ReservaCriadaMail;
use App\Models\Hotel;
use App\Models\Quarto;
use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $reservas = Reserva::with(['user', 'hotel', 'quartos'])->latest()->get();
        } else {
            $reservas = Reserva::whereHas('quartos.hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with(['user', 'hotel', 'quartos'])->latest()->get();
        }

        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $user = auth()->user();

        $quartos = ($user->role === 'admin')
            ? Quarto::with('hotel')->get()
            : Quarto::whereHas('hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('hotel')->get();

        return view('reservas.create', compact('quartos'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nome_user' => 'required|string|max:255',
        'contato'   => 'required|string|max:255',
        'email'     => 'required|email',
        'checkin'   => 'required|date',
        'checkout'  => 'required|date|after:checkin',
        'quartos'   => 'required|array|min:1',
    ]);

    $user = auth()->user(); // pode ser null

    // Filtra quartos com quantidade > 0
    $quartosSelecionados = collect($request->quartos)
        ->filter(fn($dados, $quartoId) => ($dados['quantidade'] ?? 0) > 0);

    if ($quartosSelecionados->isEmpty()) {
        return back()->withErrors(['quartos' => 'Selecione pelo menos um quarto com quantidade maior que zero.'])->withInput();
    }

    // Verifica se todos os quartos são do mesmo hotel
    $hotelIds = [];
    foreach ($quartosSelecionados as $quartoId => $dados) {
        $quarto = Quarto::find($quartoId);
        if (!$quarto) {
            return back()->withErrors(['quartos' => "Quarto ID $quartoId não encontrado."])->withInput();
        }
        $hotelIds[] = $quarto->hotel_id;
    }
    $hotelIds = array_unique($hotelIds);
    if (count($hotelIds) !== 1) {
        return back()->withErrors(['quartos' => 'Todos os quartos devem ser do mesmo hotel.'])->withInput();
    }
    $hotelId = $hotelIds[0];

    // Segurança multi-tenant para gestor (apenas se estiver logado)
    if ($user && $user->role === 'gestor') {
        $hotel = Hotel::where('id', $hotelId)->where('user_id', $user->id)->first();
        if (!$hotel) {
            return back()->withErrors(['quartos' => 'Hotel não autorizado.'])->withInput();
        }
    }

    // NÃO cria utilizador. Apenas verifica se já existe um user com este email (admin/gestor)
    $cliente = User::where('email', $request->email)->first();
    $userId = $cliente ? $cliente->id : null;

    $checkin = Carbon::parse($request->checkin);
    $checkout = Carbon::parse($request->checkout);
    $dias = max(1, $checkin->diffInDays($checkout));

    // Criar reserva com user_id podendo ser null
    $reserva = Reserva::create([
        'user_id'      => $userId,
        'hotel_id'     => $hotelId,
        'nome_user'    => $request->nome_user,
        'contato'      => $request->contato,
        'email'        => $request->email,
        'tipo_reserva' => $quartosSelecionados->count() > 1 ? 'multipla' : 'simples',
        'preco_total'  => 0,
        'checkin'      => $request->checkin,
        'checkout'     => $request->checkout,
        'status'       => 'pendente',
    ]);

    $total = 0;
    foreach ($quartosSelecionados as $quartoId => $dados) {
        $quarto = Quarto::find($quartoId);
        $quantidade = $dados['quantidade'] ?? 1;
        $subtotal = $dias * $quarto->preco * $quantidade;
        $total += $subtotal;
        $reserva->quartos()->attach($quarto->id, [
            'quantidade' => $quantidade,
            'preco'      => $quarto->preco,
        ]);
    }

    $reserva->update(['preco_total' => $total]);

    $hotel = Hotel::find($hotelId);
    $googleMapsLink = ($hotel->latitude && $hotel->longitude)
        ? "https://www.google.com/maps?q={$hotel->latitude},{$hotel->longitude}"
        : null;

    try {
        Mail::to($request->email)->send(new ReservaCriadaMail($reserva, $googleMapsLink, $hotel));
    } catch (\Exception $e) {
        \Log::error('Erro ao enviar email: ' . $e->getMessage());
    }

    return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
}

    public function update(Request $request, Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        $user = auth()->user();

        if ($user->role === 'turista') {
            abort(403);
        }

        $request->validate([
            'checkin'  => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'status'   => 'nullable|in:pendente,confirmada,cancelada',
        ]);

        $dias = max(1, Carbon::parse($request->checkin)->diffInDays(Carbon::parse($request->checkout)));
        $total = 0;
        foreach ($reserva->quartos as $quarto) {
            $subtotal = $dias * $quarto->pivot->preco * $quarto->pivot->quantidade;
            $total += $subtotal;
        }

        $reserva->update([
            'checkin'     => $request->checkin,
            'checkout'    => $request->checkout,
            'preco_total' => $total,
            'status'      => $request->status ?? $reserva->status,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva atualizada.');
    }

    public function destroy(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva removida.');
    }

    private function authorizeReserva(Reserva $reserva)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return;
        }

        $isGestor = $reserva->quartos()->whereHas('hotel', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->exists();

        $isOwner = $reserva->user_id === $user->id;

        if (!$isGestor && !$isOwner) {
            abort(403, 'Não autorizado.');
        }
    }

    public function confirm(Reserva $reserva)
{
    // Verifica permissões (admin ou gestor do hotel)
    $this->authorizeReserva($reserva);

    // Atualiza o status para 'confirmada'
    $reserva->update(['status' => 'confirmada']);

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva confirmada com sucesso.');
}

public function cancel(Reserva $reserva)
{
    $this->authorizeReserva($reserva);
    $reserva->update(['status' => 'cancelada']);
    return redirect()->route('reservas.index')
        ->with('success', 'Reserva cancelada.');
}
}