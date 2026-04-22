@extends('layouts.user')

@section('content')

<h1>Pontos Turísticos</h1>

@forelse($pontos as $ponto)

    <div>

        <h2>{{ $ponto->nome }}</h2>

        <p><strong>Localização:</strong> {{ $ponto->localizacao }}</p>

        <p><strong>Categoria:</strong> {{ $ponto->categoria }}</p>

        <div>
            @if($ponto->imagens->isNotEmpty())
                <img src="{{ Storage::url($ponto->imagens->first()->imagem) }}" width="150">
            @else
                <p>Sem imagem</p>
            @endif
        </div>

        <a href="{{ route('user.pontosturisticos.show', $ponto->id) }}">
            Ver detalhes
        </a>

        <hr>

    </div>

@empty

    <p>Nenhum ponto turístico disponível.</p>

@endforelse

@endsection