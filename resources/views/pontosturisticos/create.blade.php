@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Criar Ponto Turístico</h1>


    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pontosturisticos.store') }}" method="POST">
        @csrf

            <label for="nome" class="block text-sm font-semibold text-texto-escuro mb-1">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
            
            <label for="localizacao" class="block text-sm font-semibold text-texto-escuro mb-1">Localização</label>
            <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        
            <label for="descricao" class="block text-sm font-semibold text-texto-escuro mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ old('descricao') }}</textarea>
       
            <label for="categoria" class="block text-sm font-semibold text-texto-escuro mb-1">Categoria</label>
            <select name="categoria" id="categoria" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
                <option value=""> Seleciona </option>
                <option value="Praia" {{ old('categoria') == 'Praia' ? 'selected' : '' }}>Praia</option>
                <option value="Museu" {{ old('categoria') == 'Museu' ? 'selected' : '' }}>Museu</option>
                <option value="Monumento" {{ old('categoria') == 'Monumento' ? 'selected' : '' }}>Monumento</option>
                <option value="Parque" {{ old('categoria') == 'Parque' ? 'selected' : '' }}>Parque</option>
                <option value="Outro" {{ old('categoria') == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        
            <label for="contato" class="block text-sm font-semibold text-texto-escuro mb-1">Contato (opcional)</label>
            <input type="text" name="contato" id="contato" value="{{ old('contato') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">

        <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Criar</button></center>
    </form>

    <a href="{{ route('pontosturisticos.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Voltar</a>
@endsection