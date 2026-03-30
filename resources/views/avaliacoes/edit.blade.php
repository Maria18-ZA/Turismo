@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Avaliação</h1>

    <form action="{{ route('avaliacoes.update', $avaliacao) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $avaliacao->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="hotel_id" class="form-label">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}" {{ $avaliacao->hotel_id == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pontoturistico_id" class="form-label">Ponto Turístico</label>
            <select name="pontoturistico_id" id="pontoturistico_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($pontos as $ponto)
                    <option value="{{ $ponto->id }}" {{ $avaliacao->pontoturistico_id == $ponto->id ? 'selected' : '' }}>
                        {{ $ponto->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nota" class="form-label">Nota (0 a 5)</label>
            <input type="number" name="nota" id="nota" class="form-control" min="0" max="5" value="{{ $avaliacao->nota }}" required>
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">Comentário</label>
            <textarea name="comentario" id="comentario" class="form-control">{{ $avaliacao->comentario }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('avaliacoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection