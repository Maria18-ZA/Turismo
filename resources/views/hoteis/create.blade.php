@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Criar Hotel</h1>

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
    <div >
    <form action="{{ route('hoteis.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
        <label for="nome" class="block text-sm font-semibold text-texto-escuro mb-1">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">

        <label for="localizacao" class="block text-sm font-semibold text-texto-escuro mb-1">Localização</label>
        <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    
        
        <label class="block text-sm font-semibold text-texto-escuro mb-1"> Latitude</label>
        <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="w-full border border-borda-card rounded-lg px-4 py-2">
   
         <label class="block text-sm font-semibold text-texto-escuro mb-1">Longitude </label>
         <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="w-full border border-borda-card rounded-lg px-4 py-2">
         
         <label for="categoria" class="block text-sm font-semibold text-texto-escuro mb-1">Categoria</label>
           
         <select name="categoria" id="categoria" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
                <option value=""> Seleciona </option>
                <option value="Praia" {{ old('categoria') == 'Praia' ? 'selected' : '' }}>Moderna</option>
                <option value="Museu" {{ old('categoria') == 'Museu' ? 'selected' : '' }}>3 Estrelas</option>
                <option value="Monumento" {{ old('categoria') == 'Monumento' ? 'selected' : '' }}> 5 Estrelas</option>
                <option value="Parque" {{ old('categoria') == 'Parque' ? 'selected' : '' }}>Premium</option>
                <option value="Outro" {{ old('categoria') == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>

        <label for="descricao" class="block text-sm font-semibold text-texto-escuro mb-1">Descrição</label>
        <textarea name="descricao" id="descricao" class="w-1/2 border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ old('descricao') }}</textarea>
   
        <label for="imagens">Imagem</label>
        <input type="file" multiple name="imagens[]" id="imagens" >

        <label for="contato" class="block text-sm font-semibold text-texto-escuro mb-1">Contato</label>
        <input type="text" name="contato" id="contato" value="{{ old('contato') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">

    
      <center>  <button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Criar</button></center>
</form> 
</div>
    <br>
     <a href="{{ route('hoteis.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Voltar</a>
@endsection 
      