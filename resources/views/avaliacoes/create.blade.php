@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Avaliação</h1>

    <form action="{{ route('avaliacoes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="hotel_id" class="form-label">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pontoturistico_id" class="form-label">Ponto Turístico</label>
            <select name="pontoturistico_id" id="pontoturistico_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($pontos as $ponto)
                    <option value="{{ $ponto->id }}">{{ $ponto->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nota" class="form-label">Nota (0 a 5)</label>
            <input type="number" name="nota" id="nota" class="form-control" min="0" max="5" required>
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">Comentário</label>
            <textarea name="comentario" id="comentario" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('avaliacoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection