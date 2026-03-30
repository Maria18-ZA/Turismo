@extends('layouts.app')

@section('content')
    <h1>Serviços</h1>

    <a href="{{ route('servicos.create') }}">Criar Serviço</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($servicos as $servico)
                <tr>
                    <td>{{ $servico->nome }}</td>
                    <td>{{ $servico->tipo }}</td>
                    <td>
                        <a href="{{ route('servicos.show', $servico) }}">Ver mais</a>
                        <a href="{{ route('servicos.edit', $servico) }}">Editar</a>
                        <form action="{{ route('servicos.destroy', $servico) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum serviço encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection