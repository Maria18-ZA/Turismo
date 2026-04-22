@extends('layouts.user')

@section('content')

<h1>{{ $pontoTuristico->nome }}</h1>

<p><strong>Localização:</strong> {{ $pontoTuristico->localizacao }}</p>

<p><strong>Categoria:</strong> {{ $pontoTuristico->categoria }}</p>

<p><strong>Descrição:</strong></p>
<p>{{ $pontoTuristico->descricao }}</p>

<hr>

<h3>Imagens</h3>

@forelse($pontoTuristico->imagens as $imagem)
    <img src="{{ Storage::url($imagem->imagem) }}" width="200">
@empty
    <p>Sem imagens disponíveis.</p>
@endforelse

<hr>

<a href="{{ route('user.pontosturisticos.index') }}">
    Voltar
</a>

@endsection