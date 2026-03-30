@extends('layouts.app')

@section('content')
    <h1>{{ $pontoTuristico->nome }}</h1>

    <a href="{{ route('pontosturisticos.index') }}">← Voltar à lista</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <td>{{ $pontoTuristico->nome }}</td>
        </tr>
        <tr>
            <th>Localização</th>
            <td>{{ $pontoTuristico->localizacao }}</td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>{{ $pontoTuristico->descricao }}</td>
        </tr>
        <tr>
            <th>Categoria</th>
            <td>{{ $pontoTuristico->categoria }}</td>
        </tr>
        <tr>
            <th>Contato</th>
            <td>{{ $pontoTuristico->contato ?? 'Não disponível' }}</td>
        </tr>
        <tr>
            <th>Criado em</th>
            <td>{{ $pontoTuristico->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('pontosturisticos.edit', $pontoTuristico) }}">Editar</a>

    <form action="{{ route('pontosturisticos.destroy', $pontoTuristico) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection