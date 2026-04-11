@extends('layouts.app')

@section('content')
    <h1>{{ $hotel->nome }}</h1>

    <a href="{{ route('hoteis.index') }}" >Voltar</a>

    <table border="1">

         <tr>
            <th>ID</th>
            <td>{{ $hotel->id }}</td>
        </tr>
        <tr>
            <th>Nome</th>
            <td>{{ $hotel->nome }}</td>
        </tr>
        <tr>
            <th>Localização</th>
            <td>{{ $hotel->localizacao }}</td>
        </tr>
        <tr>
            <th>Categoria</th>
            <td>{{ $hotel->categoria }}</td>
        </tr>
        <th>Imagem</th>
            <td>
                @if($hotel->imagens->isNotEmpty())
                    <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}" alt="Imagem do Hotel" class="w-16 h-16 object-cover rounded-lg">
                @else
                    <p class="text-texto-escuro">Nenhuma imagem disponível</p>
                @endif
            </td>
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

    <a href="{{ route('hoteis.edit', $hotel->id) }}">Editar</a>

    <form action="{{ route('hoteis.destroy', $hotel->id ) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection