@extends('layouts.app')

@section('content')
    <h1>Pontos Turísticos</h1>

    <a href="{{ route('pontosturisticos.create') }}">Criar Ponto Turístico</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Localização</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pontos as $ponto)
                <tr>
                    <td>{{ $ponto->nome }}</td>
                    <td>{{ $ponto->localizacao }}</td>
                    <td>{{ $ponto->categoria }}</td>
                    <td>
                        <a href="{{ route('pontosturisticos.show', $ponto) }}">Ver mais</a>
                        <a href="{{ route('pontosturisticos.edit', $ponto) }}">Editar</a>
                        <form action="{{ route('pontosturisticos.destroy', $ponto) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum ponto turístico encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection