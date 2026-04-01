@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-texto-escuro mb-6"> </h1>

    <a href="{{ route('hoteis.index') }}" class="bg-primaria text-white text-sm font-bold
              px-5 py-2.5 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Voltar</a>
</div>    
    @if($errors->any())

     <div class="mb-4 bg-red-100 border border-red-300 text-red-600 p-4 rounded-lg">
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
    @endif
    <div class="max-w-2xl mx-auto mt-10">
    <form action="{{ route('hoteis.store') }}" method="POST">
    @csrf

    <div>
        <label for="nome" class="list-disc  text-sm font-semibold text-texto-escuro mb-1">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    </div>

    <div>
        <label for="localizacao" class="block text-sm   font-semibold text-texto-escuro mb-1">Localização</label>
        <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    </div>

    <div
        <label for="descricao" class="block text-sm   font-semibold text-texto-escuro mb-1">Descrição</label>
        <textarea name="descricao" id="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ old('descricao') }}</textarea>
    </div>

    <div>
        <label for="contato" class="block text-sm   font-semibold text-texto-escuro mb-1">Contato</label>
        <input type="text" name="contato" id="contato" value="{{ old('contato') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    </div>

    <div class="pt-4">
      <center>  <button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Criar</button></center>
    </div>
</form> {{-- FECHAR FORM --}}
</div>
@endsection 
      