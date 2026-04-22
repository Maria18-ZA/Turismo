@extends('layouts.user')

@section('content')

<h1>Culturas</h1>

@forelse($culturas as $cultura)

    <div>

        <p><strong>Nome:</strong> {{ $culturas->nome }}</p>

        <p><strong>Tipo:</strong> {{ $cultura->tipo }}</p>

        <p><strong>Descrição:</strong> {{ $cultura->descricao }}</p>

        <p><strong>Localização:</strong> {{ $cultura->localizacao }}</p>

        <p><strong>Data:</strong> {{ $cultura->data }}</p>

        <div>
            @if($cultura->imagens->isNotEmpty())
                <img src="{{ Storage::url($cultura->imagens->first()->imagem) }}" width="150">
            @else
                <p>Sem imagem</p>
            @endif
        </div>

        <a href="{{ route('user.culturas.show', $cultura->id) }}">
            Ver detalhes
        </a>

        <hr>

    </div>

@empty

    <p>Nenhuma cultura disponível.</p>

@endforelse

@endsection