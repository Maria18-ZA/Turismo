@extends('layouts.app')
@section('content')
<h1>Reserva #{{ $reserva->id }}</h1>
<p><strong>Nome:</strong> {{ $reserva->nome_user }}</p>
<p><strong>Check-in:</strong> {{ $reserva->checkin }}</p>
<p><strong>Check-out:</strong> {{ $reserva->checkout }}</p>
<p><strong>Status:</strong> {{ $reserva->status }}</p>
<p><strong>Preço total:</strong> {{ number_format($reserva->preco_total, 2) }}€</p>
<h3>Quartos:</h3>
<ul>
    @foreach($reserva->quartos as $q)
        <li>{{ $q->numero }} - {{ $q->tipo }} (x{{ $q->pivot->quantidade }}, {{ number_format($q->pivot->preco, 2) }}€/noite)</li>
    @endforeach
</ul>
<a href="{{ route('reservas.index') }}">Voltar</a>
@endsection