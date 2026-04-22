@extends('layouts.user')

@section('content')

<h1>{{ $cultura->nome }}</h1>

<p><strong>Tipo:</strong> {{ $cultura->tipo }}</p>

<p><strong>Descrição:</strong> {{ $cultura->descricao }}</p>

<p><strong>Localização:</strong> {{ $cultura->localizacao }}</p>

<p><strong>Data:</strong> {{ $cultura->data }}</p>

<h3>Imagens</h3>

@forelse($cultura->imagens as $imagem)
    <img src="{{ Storage::url($imagem->imagem) }}" width="200">
@empty
    <p>Sem imagens</p>
@endforelse

<a href="{{ route('user.culturas.index') }}">Voltar</a>

@endsection