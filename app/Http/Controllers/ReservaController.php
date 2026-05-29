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
        $this->middleware('auth'); // Todas as rotas exigem autenticação
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $reservas = Reserva::with(['cliente', 'hotel', 'quartos'])->latest()->get();
        } else {
            $reservas = Reserva::whereHas('quartos.hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with(['cliente', 'hotel', 'quartos'])->latest()->get();
        }

        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $user = auth()->user();

        // Para gestor e admin, listar quartos dos hotéis que têm acesso
        $quartos = ($user->role === 'admin')
            ? Quarto::with('hotel')->get()
            : Quarto::whereHas('hotel', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('hotel')->get();

        // Se for turista, apenas pode criar reserva para si mesmo, então não precisa lista de users
        // Mas mantemos a view simples: o formulário pede nome, contato, email (que serão do turista logado)
        // Se quiser permitir turista criar para outro, seria diferente. Vou assumir que turista cria para si.
        // Então na view, para turista, os campos nome/contato/email já vêm preenchidos com os dados do user.

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
            'quartos.*.id' => 'required|exists:quartos,id',
            'quartos.*.quantidade' => 'integer|min:1',
        ]);

        $user = auth()->user();

        // Processar quartos selecionados (estrutura esperada: array de objetos com id e quantidade)
        $quartosSelecionados = collect($request->quartos)
            ->filter(fn($item) => isset($item['id']) && ($item['quantidade'] ?? 1) > 0);

        if ($quartosSelecionados->isEmpty()) {
            return back()->withErrors(['quartos' => 'Selecione pelo menos um quarto com quantidade válida.'])->withInput();
        }

        // Verificar se todos os quartos pertencem ao mesmo hotel
        $hotelIds = [];
        foreach ($quartosSelecionados as $item) {
            $quarto = Quarto::find($item['id']);
            if (!$quarto) continue;
            $hotelIds[] = $quarto->hotel_id;
        }
        $hotelIds = array_unique($hotelIds);
        if (count($hotelIds) !== 1) {
            return back()->withErrors(['quartos' => 'Todos os quartos devem ser do mesmo hotel.'])->withInput();
        }
        $hotelId = $hotelIds[0];

        // Segurança para gestor: verificar se o hotel pertence ao gestor
        if ($user->role === 'gestor') {
            $hotel = Hotel::where('id', $hotelId)->where('user_id', $user->id)->first();
            if (!$hotel) {
                abort(403, 'Não autorizado.');
            }
        }

        // Para turista: verificar se o email corresponde ao user logado (ou se é admin pode criar para qualquer email)
        if ($user->role === 'turista' && $user->email !== $request->email) {
            return back()->withErrors(['email' => 'Turistas só podem criar reservas para o seu próprio email.'])->withInput();
        }

        // Criar ou obter cliente (se admin/gestor, pode criar conta para qualquer email)
        $cliente = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name'     => $request->nome_user,
                'contato'  => $request->contato,
                'password' => Hash::make(Str::random(16)),
                'role'     => 'turista',
            ]
        );
        // Atualizar nome/contato se necessário
        if ($cliente->name !== $request->nome_user || $cliente->contato !== $request->contato) {
            $cliente->update([
                'name' => $request->nome_user,
                'contato' => $request->contato,
            ]);
        }

        $checkin = Carbon::parse($request->checkin);
        $checkout = Carbon::parse($request->checkout);
        $dias = max(1, $checkin->diffInDays($checkout));

        $total = 0;

        // Criar reserva com hotel_id correto
        $reserva = Reserva::create([
            'user_id'      => $cliente->id,
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

        foreach ($quartosSelecionados as $item) {
            $quarto = Quarto::find($item['id']);
            $quantidade = $item['quantidade'] ?? 1;
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

        Mail::to($cliente->email)->send(new ReservaCriadaMail($reserva, $googleMapsLink, $hotel));

        return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
    }

    public function show(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        $reserva->load('quartos.hotel', 'cliente');
        return view('reservas.show', compact('reserva'));
    }

    public function edit(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        // A edição de reserva pode ser complexa. Vamos permitir apenas alterar datas e status (não quartos)
        // Para simplificar, redirecionamos para uma view específica ou apenas retornamos erro.
        // Mas como no seu sistema original o edit permitia alterar user_id, vou manter apenas alteração de datas e status.
        $user = auth()->user();
        // Somente admin e gestor do hotel podem editar (turista não pode editar reserva depois de criada)
        if ($user->role === 'turista') {
            abort(403, 'Turistas não podem editar reservas.');
        }
        return view('reservas.edit', compact('reserva'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        $user = auth()->user();

        // Turista não pode editar
        if ($user->role === 'turista') {
            abort(403);
        }

        $request->validate([
            'checkin'  => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'status'   => 'nullable|in:pendente,confirmada,cancelada',
        ]);

        $dias = max(1, Carbon::parse($request->checkin)->diffInDays(Carbon::parse($request->checkout)));
        // Recalcular preço total baseado nos quartos existentes (sem alterar os quartos)
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

        // Gestor: se a reserva tiver quartos de hotéis que ele gere
        $isGestor = $reserva->quartos()->whereHas('hotel', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->exists();

        // Turista: se for o dono da reserva
        $isOwner = $reserva->user_id === $user->id;

        if (!$isGestor && !$isOwner) {
            abort(403, 'Não autorizado.');
        }
    }
}