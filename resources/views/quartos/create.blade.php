@extends('layouts.app')
@section('content')
<h1>Novo Quarto</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('quartos.store') }}" method="POST" enctype="multipart/form-data>
    @csrf
    <label>Hotel:</label>
    <select name="hotel_id">
        @foreach($hoteis as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->nome }}</option>
        @endforeach
    </select><br><br>

    <label>Número:</label>
    <input type="text" name="numero"><br><br>

    <label>Tipo:</label>
    <input type="text" name="tipo"><br><br>

    <label>Preço:</label>
    <input type="text" name="preco"><br><br>

    <label>Descrição:</label>
    <textarea name="descricao"></textarea><br><br>

    <button type="submit">Salvar</button>
</form>
@endsection