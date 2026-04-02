@extends('layouts.app')
@section('content')
<h1>Culturas</h1>
<a href="{{ route('culturas.create') }}">Nova Cultura</a>
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Localização</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>
    @foreach($culturas as $cultura)
    <tr>
        <td>{{ $cultura->id }}</td>
        <td>{{ $cultura->nome }}</td>
        <td>{{ $cultura->tipo }}</td>
        <td>{{ $cultura->localizacao }}</td>
        <td>{{ $cultura->data_celebracao }}</td>
        <td>
            <a href="{{ route('culturas.edit', $cultura->id) }}">Editar</a>
            <form action="{{ route('culturas.destroy', $cultura->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Deseja apagar?')">Apagar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection