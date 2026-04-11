@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Novo Quarto</h1>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('quartos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="nome" class="block text-sm font-semibold text-texto-escuro mb-1">Hotel:</label>
    <select name="hotel_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        @foreach($hoteis as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->nome }}</option>
        @endforeach
    </select><br><br>

    <label for="numero" class="block text-sm font-semibold text-texto-escuro mb-1">Número:</label>
    <input type="text" name="numero" id="numero" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label for="tipo" class="block text-sm font-semibold text-texto-escuro mb-1">Tipo:</label>
    <input type="text" name="tipo" id="tipo" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

     <label for="imagem" class="block text-sm font-semibold text-texto-escuro mb-1">Imagem</label>
    <input type="file" multiple name="imagem" id="imagem" ><br><br>

    <label for="descricao" class="block text-sm font-semibold text-texto-escuro mb-1">Descrição:</label>
    <textarea name="descricao" id="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"></textarea><br><br>

    <label for="preco" class="block text-sm font-semibold text-texto-escuro mb-1">Preço:</label>
    <input type="text" name="preco" id="preco" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    

    <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Salvar</button></center>
</form>
@endsection