@extends('layouts.app')
@section('content')
<h1>Reservas</h1>
<a href="{{ route('reservas.create') }}" class="bg-primaria text-white text-sm font-bold
              px-5 py-8.5 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Nova Reserva</a>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<div class="bg-white rounded-xl border border-borda-card overflow-hidden">
<table class="w-full text-sm">
     <thead class="bg-primaria text-white">
    <tr class="bg-primaria text-white">
        <th text-left px-5 py-3 font-semibold>ID</th>
        <th text-left px-5 py-3 font-semibold>Usuário</th>
        <th text-left px-5 py-3 font-semibold>Quarto</th>
        <th text-left px-5 py-3 font-semibold>Check-in</th>
        <th text-left px-5 py-3 font-semibold>Check-out</th>
        <th text-left px-5 py-3 font-semibold>Ações</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-borda-card">
    @foreach($reservas as $reserva)
    <tr class="hover:bg-fundo-secao transition-colors duration-150">
        <td class="px-5 py-3 font-medium text-texto-escuro">{{ $reserva->id }}</td>
        <td class="px-5 py-3 text-texto-medio">{{ $reserva->nome_user }}</td>
        <td class="px-5 py-3 text-texto-medio">{{ $reserva->quarto->numero ?? '-' }}</td>
        <td class="px-5 py-3 text-texto-medio">{{ $reserva->checkin }}</td>
        <td class="px-5 py-3 text-texto-medio">{{ $reserva->checkout }}</td>
        <td class="px-5 py-3">

           <div class="flex items-center gap-3">
             
            <a href="{{ route('reservas.show', $reserva->id) }}" class= "text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">Ver mais</a>
            <a href="{{ route('reservas.edit', $reserva->id) }}"   class="text-blue-600 text-xs font-bold hover:text-blue-800 transition-colors">Editar</a>
            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline" class="text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Deseja apagar?')">Apagar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection