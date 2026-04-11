@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
<h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Nova Cultura</h1>
</div>  

@if ($errors->any())
<div class="mb-4 bg-red-100 border border-red-300 text-red-600 p-4 rounded-lg">
    <ul class="list-disc pl-5 text-sm">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif

 <div class="max-w-2xl mx-auto mt-10">
<form action="{{ route('culturas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 

    <label class="block text-sm font-semibold text-texto-escuro mb-1">Nome</label>
    <input type="text" name="nome" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label class="block text-sm font-semibold text-texto-escuro mb-1">Tipo</label>
    <select name="tipo" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        <option value="">Selecione</option>
        <option value="tradicional">Tradicional</option>
        <option value="moderna">Moderna</option>
    </select><br><br>

    <label for="imagem" class="block text-sm font-semibold text-texto-escuro mb-1">Imagem</label>
    <input type="file" multiple name="imagem" id="imagem" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">

    <label class="block text-sm font-semibold text-texto-escuro mb-1">Descrição</label>
    <textarea name="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"></textarea><br><br>

    <label class="block text-sm font-semibold text-texto-escuro mb-1">Localização</label>
    <input type="text" name="localizacao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label class="block text-sm font-semibold text-texto-escuro mb-1">Data de Celebração</label>
    <input type="date" name="data_celebracao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>


    <label class="block text-sm font-semibold text-texto-escuro mb-1">Origem Étnica</label>
    <input type="text" name="origem_etnica" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Salvar</button></center>
</form>
</div>
<br>
<a href="{{ route('hoteis.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Voltar</a>
@endsection