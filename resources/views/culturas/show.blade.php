@extends('layouts.app')

@section('content')
    <h1>{{ $cultura->nome }}</h1>

    <a href="{{ route('culturas.index') }}"> Voltar à lista</a>

    <table border="1">

         <tr>
            <th>ID</th>
            <td>{{ $cultura->id }}</td>
        </tr>
        <tr>
            <th>Nome</th>
            <td>{{ $cultura->nome }}</td>
        </tr>
        <tr>
            <th>Tipo</th>
            <td>{{ $cultura->tipo }}</td>
        </tr>
       <tr>
            <th>Imagem</th>
            <td>
                @if($cultura->imagens->isNotEmpty())
                    <img src="{{ Storage::url($cultura->imagens->first()->imagem) }}" alt="Imagem da Cultura" class="w-16 h-16 object-cover rounded-lg">
                @else 
                    <p class="text-texto-escuro">Nenhuma imagem disponível</p>
                @endif
            </td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>{{ $cultura->descricao }}</td>
        </tr>
        <tr>
            <th>Localização</th>
            <td>{{ $cultura->localizacao }}</td>
        </tr>
        <tr>
            <th>Data</th>
            <td>{{ $cultura->data }}</td>
        </tr>
        <tr>
            <th>Criado em</th>
            <td>{{ $cultura->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('culturas.edit', $cultura) }}">Editar</a>

    <form action="{{ route('culturas.destroy', $cultura) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection