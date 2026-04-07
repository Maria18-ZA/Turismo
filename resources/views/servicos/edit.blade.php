@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">

    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Serviço</h1>

    
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('servicos.update', $servicos) }}" method="POST">
        @csrf
        @method('PUT')

        
            <label for="nome" class="block text-sm   font-semibold text-texto-escuro mb-1">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $servicos->nome) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
       

      
            <label for="descricao" class="block text-sm   font-semibold text-texto-escuro mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ old('descricao', $servicos->descricao) }}</textarea>


      
            <label for="tipo" class="block text-sm   font-semibold text-texto-escuro mb-1">Tipo</label>
            <select name="tipo" id="tipo" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
                <option value="">-- Seleciona --</option>
                <option value="Guia Turístico" {{ old('tipo', $servicos->tipo) == 'Guia Turístico' ? 'selected' : '' }}>Guia Turístico</option>
                <option value="Transporte" {{ old('tipo', $servicos->tipo) == 'Transporte' ? 'selected' : '' }}>Transporte</option>
                <option value="Excursão" {{ old('tipo', $servicos->tipo) == 'Excursão' ? 'selected' : '' }}>Excursão</option>
                <option value="Outro" {{ old('tipo', $servicos->tipo) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

       <center> <button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button></center>
    </form>
   
<a href="{{ route('servicos.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Voltar à lista</a>

@endsection
```