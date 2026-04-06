@extends('layouts.app')
@section('content')
<h1>Nova Reserva</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('reservas.store') }}" method="POST">
    @csrf

     <label>Nome:</label>
    <input type="text" name="nome_user" required><br><br>


    <label>Quarto:</label>
    <select name="quarto_id">
        @foreach($quartos as $quarto)
            <option value="{{ $quarto->id }}">{{ $quarto->numero }} - {{ $quarto->tipo }}</option>
        @endforeach
    </select><br><br>


    <label>Check-in:</label>
    <input type="date" name="checkin"><br><br>

    <label>Check-out:</label>
    <input type="date" name="checkout"><br><br>

    <button type="submit">Salvar</button>
</form>
@endsection