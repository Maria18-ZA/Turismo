@extends('layouts.app')

@section('content')
    <h1>{{ $hotel->nome }}</h1>

    <a href="{{ route('hoteis.index') }}">← Voltar à lista</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <td>{{ $hotel->nome }}</td>
        </tr>
        <tr>
            <th>Localização</th>
            <td>{{ $hotel->localizacao }}</td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>{{ $hotel->descricao }}</td>
        </tr>
        <tr>
            <th>Contato</th>
            <td>{{ $hotel->contato }}</td>
        </tr>
        <tr>
            <th>Criado em</th>
            <td>
    {{ $hotel->created_at ? $hotel->created_at->format('d/m/Y H:i') : 'Sem data' }}
</td>
        </tr>
    </table>

    <a href="{{ route('hoteis.edit', $hotel) }}">Editar</a>

    <form action="{{ route('hoteis.destroy', $hotel ) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection