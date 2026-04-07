@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">

<h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Reserva</h1>

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
    
    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Usuário:</label>
    <select name="user_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        @foreach($users as $user)
            <option value="{{ $user->id }}" @if($reserva->user_id==$user->id) selected @endif>{{ $user->name }}</option>
        @endforeach
    </select><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Quarto:</label>
    <select name="quarto_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria>
        @foreach($quartos as $quarto)
            <option value="{{ $quarto->id }}" @if($reserva->quarto_id==$quarto->id) selected @endif>{{ $quarto->numero }} - {{ $quarto->tipo }}</option>
        @endforeach
    </select><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Check-in:</label>
    <input type="date" name="check_in" value="{{ $reserva->check_in }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Check-out:</label>
    <input type="date" name="check_out" value="{{ $reserva->check_out }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button></center>
</form>
<a href="{{ route('reservas.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Voltar</a>
@endsection