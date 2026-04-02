@extends('layouts.app')
@section('content')
<h1>Quartos</h1>
<a href="{{ route('quartos.create') }}">Novo Quarto</a>
<table>
    <tr>
        <th>ID</th>
        <th>Número</th>
        <th>Tipo</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    @foreach($quartos as $quarto)
    <tr>
        <td>{{ $quarto->id }}</td>
        <td>{{ $quarto->numero }}</td>
        <td>{{ $quarto->tipo }}</td>
        <td>{{ $quarto->preco }}</td>
        <td>
            <a href="{{ route('quartos.edit', $quarto->id) }}">Editar</a>
            <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit">Apagar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection