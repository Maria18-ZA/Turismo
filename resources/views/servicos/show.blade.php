@extends('layouts.app')

@section('content')
    <h1>{{ $servicos->nome }}</h1>

    <a href="{{ route('servicos.index') }}">← Voltar à lista</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <td>{{ $servicos->nome }}</td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>{{ $servicos->descricao }}</td>
        </tr>
        <tr>
            <th>Tipo</th>
            <td>{{ $servicos->tipo }}</td>
        </tr>
        <tr>
            <th>Criado em</th>
            <td>{{ $servicos->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('servicos.edit', $servicos) }}">Editar</a>

    <form action="{{ route('servicos.destroy', $servicos) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection