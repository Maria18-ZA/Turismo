@extends('layouts.app')

@section('content')
    <h1>{{ $quarto->nome }}</h1>

    <a href="{{ route('quartos.index') }}"> Voltar à lista</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <td>{{ $quarto->id }}</td>
        </tr>
        <tr>
            <th>Número</th>
            <td>{{ $quarto->numero }}</td>
        </tr>
        <tr>
            <th>Tipo</th>
            <td>{{ $quarto->tipo }}</td>
        </tr>
        <tr>
            <th>Imagem</th>
            <td>
                @if($quarto->imagens->isNotEmpty())
                    <img src="{{ Storage::url($quarto->imagens->first()->imagem) }}" alt="Imagem do Quarto" class="w-16 h-16 object-cover rounded-lg">
                @else
                    <p class="text-texto-escuro">Nenhuma imagem disponível</p>
                @endif
            </td>
        </tr>
        <tr>
            <th>Preço</th>
            <td>{{ $quarto->preco }}</td>
        </tr>
            <tr>
                <th>Disponível</th>
                <td>{{ $quarto->disponivel ? 'Sim' : 'Não' }}</td>
            </tr>
            <tr>
                <th>Criado em</th>
                <td>{{ $quarto->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tr>
    </table>

    <a href="{{ route('quartos.edit', $quarto) }}">Editar</a>

    <form action="{{ route('quartos.destroy', $quarto) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tens a certeza?')">Eliminar</button>
    </form>
@endsection