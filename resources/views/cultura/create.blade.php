@extends('layouts.app')
@section('content')
<h1>Nova Cultura</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('culturas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nome:</label>
    <input type="text" name="nome"><br><br>

    <label>Tipo:</label>
    <select name="tipo">
        <option value="">--Selecione--</option>
        <option value="tradicional">Tradicional</option>
        <option value="moderna">Moderna</option>
    </select><br><br>

    <label>Descrição:</label>
    <textarea name="descricao"></textarea><br><br>

    <label>Localização:</label>
    <input type="text" name="localizacao"><br><br>

    <label>Data de Celebração:</label>
    <input type="date" name="data_celebracao"><br><br>

    <label>Foto Capa:</label>
    <input type="file" name="foto_capa"><br><br>

    <label>Origem Étnica:</label>
    <input type="text" name="origem_etnica"><br><br>

    <button type="submit">Salvar</button>
</form>
@endsection