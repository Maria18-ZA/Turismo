@extends('layouts.app')
@section('content')
<h1>Reservas</h1>

<a href="{{ route('reservas.create') }}" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Nova Reserva</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<div class="bg-white rounded-xl border border-borda-card overflow-hidden mt-4">
<table class="w-full text-sm">
    <thead class="bg-primaria text-white">
        <tr>
            <th class="text-left px-5 py-3 font-semibold">ID</th>
            <th class="text-left px-5 py-3 font-semibold">Usuário</th>
            <th class="text-left px-5 py-3 font-semibold">Email</th>
            <th class="text-left px-5 py-3 font-semibold">Quartos</th>
            <th class="text-left px-5 py-3 font-semibold">Check-in</th>
            <th class="text-left px-5 py-3 font-semibold">Check-out</th>
            <th class="text-left px-5 py-3 font-semibold">Status</th>
            <th class="text-left px-5 py-3 font-semibold">Ações</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-borda-card">
        @foreach($reservas as $reserva)
        <tr class="hover:bg-fundo-secao transition-colors duration-150">
            <td class="px-5 py-3 font-medium text-texto-escuro">{{ $reserva->id }}</td>
            <td class="px-5 py-3 text-texto-medio">{{ $reserva->nome_user }}</td>
            <td class="px-5 py-3 text-texto-medio">{{ $reserva->nome }}</td>
            <td class="px-5 py-3 text-texto-medio">
                @if($reserva->quartos->isNotEmpty())
                    @foreach($reserva->quartos as $q)
                        {{ $q->numero }} (x{{ $q->pivot->quantidade }})@if(!$loop->last), @endif
                    @endforeach
                @else
                    -
                @endif
            </td>
            <td class="px-5 py-3 text-texto-medio">{{ $reserva->checkin }}</td>
            <td class="px-5 py-3 text-texto-medio">{{ $reserva->checkout }}</td>
            <td class="px-5 py-3 text-texto-medio capitalize">{{ $reserva->status }}</td>
            <td class="px-5 py-3 text-center font-medium text-texto-escuro">
                <a href="{{ route('reservas.show', $reserva->id) }}" class="text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">Ver mais</a>
               @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'gestor']))
    @if($reserva->status === 'pendente')
        <form action="{{ route('reservas.confirm', $reserva->id) }}" method="POST" style="display:inline">
            @csrf
            <button class="text-green-600 text-xs font-bold ml-2">Confirmar</button>
        </form>
        <form action="{{ route('reservas.cancel', $reserva->id) }}" method="POST" style="display:inline">
            @csrf
            <button class="text-red-600 text-xs font-bold ml-2">Cancelar</button>
        </form>
    @endif
@endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection