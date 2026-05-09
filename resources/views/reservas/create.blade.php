@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Nova Reserva</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <label for="nome_user" class="block text-sm font-semibold text-texto-escuro mb-1">Nome:</label>
        <input type="text" name="nome_user" id="nome_user" required
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

        {{-- Campo de e-mail (obrigatório) --}}
        <label for="email" class="block text-sm font-semibold text-texto-escuro mb-1">E-mail:</label>
        <input type="email" name="email" id="email" required
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

        <label for="checkin" class="block text-sm font-semibold text-texto-escuro mb-1">Check-in:</label>
        <input type="date" name="checkin" id="checkin" required
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

        <label for="checkout" class="block text-sm font-semibold text-texto-escuro mb-1">Check-out:</label>
        <input type="date" name="checkout" id="checkout" required
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

        <h2 class="text-lg font-semibold mt-6 mb-3">Escolha os quartos:</h2>
        @foreach($quartos as $quarto)
            <div class="flex items-center gap-4 mb-2 border p-2 rounded">
                <input type="checkbox"
                       name="quartos[{{ $quarto->id }}][ativo]"
                       value="1"
                       class="w-4 h-4">
                <span class="flex-1">{{ $quarto->numero }} - {{ $quarto->tipo }} ({{ number_format($quarto->preco, 2) }}€/noite)</span>
                <input type="number"
                       name="quartos[{{ $quarto->id }}][quantidade]"
                       min="1"
                       value="1"
                       class="w-20 border rounded px-2 py-1">
            </div>
        @endforeach

        <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Salvar</button></center>
    </form>

    <a href="{{ route('reservas.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-20 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Voltar</a>
</div>
@endsection