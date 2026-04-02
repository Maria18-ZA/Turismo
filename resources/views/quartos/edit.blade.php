@extends('layouts.app')
@section('content')
<h1>Editar Quarto</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('quartos.update', $quarto->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Hotel:</label>
    <select name="hotel_id">
        @foreach($hoteis as $hotel)
            <option value="{{ $hotel->id }}" @if($quarto->hotel_id == $hotel->id) selected @endif>{{ $hotel->nome }}</option>
        @endforeach
    </select><br><br>

    <label>Número:</label>
    <input type="text" name="numero" value="{{ $quarto->numero }}"><br><br>

    <label>Tipo:</label>
    <input type="text" name="tipo" value="{{ $quarto->tipo }}"><br><br>

    <label>Preço:</label>
    <input type="text" name="preco" value="{{ $quarto->preco }}"><br><br>

    <label>Descrição:</label>
    <textarea name="descricao">{{ $quarto->descricao }}</textarea><br><br>

    <button type="submit">Atualizar</button>
</form>
@endsection