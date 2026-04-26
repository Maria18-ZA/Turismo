@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Hotel</h1>

    
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('hoteis.update', $hotel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <label for="nome" class="block text-sm   font-semibold text-texto-escuro mb-1">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $hotel->nome) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        
            <label for="localizacao" class="block text-sm   font-semibold text-texto-escuro mb-1">Localização</label>
            <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao', $hotel->localizacao) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    
            <label for="descricao" class="block text-sm   font-semibold text-texto-escuro mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" class="border border-borda-card rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ old('descricao', $hotel->descricao) }}</textarea>
        
            <label for="imagens" class="block text-sm   font-semibold text-texto-escuro mb-1">Imagens (opcional)</label>
            <input type="file" name="imagens[]" id="imagens" multiple class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">

            <label for="contato" class="block text-sm   font-semibold text-texto-escuro mb-1">Contato</label>
            <input type="text" name="contato" id="contato" value="{{ old('contato', $hotel->contato) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"           >
        

       <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button></center>
    </form>

    <a href="{{ route('hoteis.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Voltar à lista</a>

@endsection