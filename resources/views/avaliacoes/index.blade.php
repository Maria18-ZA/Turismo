@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Avaliações</h1>

    <a href="{{ route('avaliacoes.create') }}" class="btn btn-primary mb-3">Nova Avaliação</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Hotel</th>
                <th>Ponto Turístico</th>
                <th>Nota</th>
                <th>Comentário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avaliacoes as $avaliacao)
            <tr>
                <td>{{ $avaliacao->id }}</td>
                <td>{{ $avaliacao->user->name }}</td>
                <td>{{ $avaliacao->hotel ? $avaliacao->hotel->nome : '-' }}</td>
                <td>{{ $avaliacao->pontoTuristico ? $avaliacao->pontoTuristico->nome : '-' }}</td>
                <td>{{ $avaliacao->nota }}</td>
                <td>{{ $avaliacao->comentario }}</td>
                <td>
                    <a href="{{ route('avaliacoes.show', $avaliacao) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('avaliacoes.edit', $avaliacao) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('avaliacoes.destroy', $avaliacao) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection