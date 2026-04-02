@extends('layouts.app')
@section('content')
<h1>Reservas</h1>
<a href="{{ route('reservas.create') }}">Nova Reserva</a>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Usuário</th>
        <th>Quarto</th>
        <th>Check-in</th>
        <th>Ações</th>
    </tr>
    @foreach($reservas as $reserva)
    <tr>
        <td>{{ $reserva->id }}</td>
        <td>{{ $reserva->user->name ?? '-' }}</td>
        <td>{{ $reserva->quarto->numero ?? '-' }}</td>
        <td>{{ $reserva->check_in }}</td>
        <td>
            <a href="{{ route('reservas.edit', $reserva->id) }}">Editar</a>
            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Deseja apagar?')">Apagar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection