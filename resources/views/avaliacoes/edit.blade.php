@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('avaliacoes.store') }}">
    @csrf

    {{-- Escolher hotel (opcional) --}}
    <select name="hotel_id">
        <option value="">Selecione um hotel</option>
        @foreach($hoteis as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->nome }}</option>
        @endforeach
    </select>

    {{-- OU ponto turístico --}}
    <select name="pontoturistico_id">
        <option value="">Selecione um ponto turístico</option>
        @foreach($pontos as $ponto)
            <option value="{{ $ponto->id }}">{{ $ponto->nome }}</option>
        @endforeach
    </select>

    {{-- Estrelas --}}
    <select name="estrela" required>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
    </select>

    {{-- Comentário --}}
    <textarea name="comentario" placeholder="Escreva sua opinião..."></textarea>

    <button type="submit">Editar Avaliação</button>
</form>