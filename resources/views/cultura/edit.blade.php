@extends('layouts.app')
@section('content')
<h1>Editar Cultura</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('culturas.update', $cultura->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Nome:</label>
    <input type="text" name="nome" value="{{ $cultura->nome }}"><br><br>

    <label>Tipo:</label>
    <select name="tipo">
        <option value="">--Selecione--</option>
        <option value="tradicional" @if($cultura->tipo=='tradicional') selected @endif>Tradicional</option>
        <option value="moderna" @if($cultura->tipo=='moderna') selected @endif>Moderna</option>
    </select><br><br>

    <label>Descrição:</label>
    <textarea name="descricao">{{ $cultura->descricao }}</textarea><br><br>

    <label>Localização:</label>
    <input type="text" name="localizacao" value="{{ $cultura->localizacao }}"><br><br>

    <label>Data de Celebração:</label>
    <input type="date" name="data_celebracao" value="{{ $cultura->data_celebracao }}"><br><br>

    <label>Foto Capa:</label>
    <input type="file" name="foto_capa"><br><br>

    <label>Origem Étnica:</label>
    <input type="text" name="origem_etnica" value="{{ $cultura->origem_etnica }}"><br><br>

    <button type="submit">Atualizar</button>
</form>
@endsection