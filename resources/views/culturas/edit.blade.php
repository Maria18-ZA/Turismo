@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">

<h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Cultura</h1>
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
    <label for="nome" class="block text-sm font-semibold text-texto-escuro mb-1">Nome:</label>
    <input type="text" name="nome" id="nome" value="{{ $cultura->nome }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label for="tipo" class="block text-sm   font-semibold text-texto-escuro mb-1">Tipo:</label>
    <select name="tipo" id="tipo" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        <option value="">--Selecione--</option>
        <option value="tradicional" @if($cultura->tipo=='tradicional') selected @endif>Tradicional</option>
        <option value="moderna" @if($cultura->tipo=='moderna') selected @endif>Moderna</option>
    </select><br><br> 

    <label for="descricao" class="block text-sm font-semibold text-texto-escuro mb-1">Descrição:</label>
    <textarea name="descricao" id="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ $cultura->descricao }}</textarea><br><br>

    <label for="localizacao" class="block text-sm font-semibold text-texto-escuro mb-1">Localização:</label>
    <input type="text" name="localizacao" id="localizacao" value="{{ $cultura->localizacao }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label for="data_celebracao" class="block text-sm font-semibold text-texto-escuro mb-1">Data de Celebração:</label>
    <input type="date" name="data_celebracao" id="data_celebracao" value="{{ $cultura->data_celebracao }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label for="foto_capa" class="block text-sm font-semibold text-texto-escuro mb-1">Foto Capa:</label>
    <input type="file" name="foto_capa" id="foto_capa" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label for="origem_etnica" class="block text-sm font-semibold text-texto-escuro mb-1">Origem Étnica:</label>
    <input type="text" name="origem_etnica" id="origem_etnica" value="{{ $cultura->origem_etnica }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button></center>
</form>
@endsection