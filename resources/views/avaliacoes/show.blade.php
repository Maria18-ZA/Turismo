@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visualizar Avaliação</h1>

    <p><strong>ID:</strong> {{ $avaliacao->id }}</p>
    <p><strong>Usuário:</strong> {{ $avaliacao->user->name }}</p>
    <p><strong>Hotel:</strong> {{ $avaliacao->hotel ? $avaliacao->hotel->nome : '-' }}</p>
    <p><strong>Ponto Turístico:</strong> {{ $avaliacao->pontoTuristico ? $avaliacao->pontoTuristico->nome : '-' }}</p>
    <p><strong>Nota:</strong> {{ $avaliacao->nota }}</p>
    <p><strong>Comentário:</strong> {{ $avaliacao->comentario }}</p>

    <a href="{{ route('avaliacoes.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection