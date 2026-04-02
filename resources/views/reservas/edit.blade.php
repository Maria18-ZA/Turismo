@extends('layouts.app')
@section('content')
<h1>Editar Reserva</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Usuário:</label>
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}" @if($reserva->user_id==$user->id) selected @endif>{{ $user->name }}</option>
        @endforeach
    </select><br><br>

    <label>Quarto:</label>
    <select name="quarto_id">
        @foreach($quartos as $quarto)
            <option value="{{ $quarto->id }}" @if($reserva->quarto_id==$quarto->id) selected @endif>{{ $quarto->numero }} - {{ $quarto->tipo }}</option>
        @endforeach
    </select><br><br>

    <label>Check-in:</label>
    <input type="date" name="check_in" value="{{ $reserva->check_in }}"><br><br>

    <button type="submit">Atualizar</button>
</form>
@endsection