@extends('layouts.app')

@section('content')
    <h1>{{ $servico->nome }}</h1>

    <a href="{{ route('servicos.index') }}">Voltar à lista</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <td>{{ $servico->nome }}</td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>{{ $servico->descricao }}</td>
        </tr>
        <tr>
            <th>Tipo</th>
            <td>{{ $servico->tipo }}</td>
        </tr>
        <tr>
            <th>Criado em</th>
            <td>{{ $servico->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('servicos.edit', $servico) }}">Editar</a>

    <form action="{{ route('servicos.destroy', $servico) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection