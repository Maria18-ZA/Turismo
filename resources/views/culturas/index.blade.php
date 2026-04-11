@extends('layouts.app')
@section('content')

<div class="flex items-center justify-between mb-8">
    <h1 class="text-texto-escuro text-3xl font-black  pb-2 border-b-4 border-primaria-light w-fit">Lista de Culturas</h1>

    <a href="{{ route('culturas.create') }}" class="bg-primaria text-white text-sm font-bold
              px-5 py-2.5 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Criar Cultura</a>
</div>


@if(session('success'))

    <p style="color:green">{{ session('success') }}</p>
@endif

 <div class="bg-white mt-10 rounded-lg border border-borda-card overflow-hidden">

<table class="w-full text-sm">
    <thead class="bg-primaria text-white">
    <tr>
        <th text-center px-5 py-3 font-semibold>ID</th>
        <th text-center px-5 py-3 font-semibold>Nome</th>
        <th text-center px-5 py-3 font-semibold>Tipo</th>
        <th text-center px-5 py-3 font-semibold>Imagem</th>
        <th text-center px-5 py-3 font-semibold>Descrição</th>
        <th text-center px-5 py-3 font-semibold>Localização</th>
        <th text-center px-5 py-3 font-semibold>Data</th>
        <th text-center px-5 py-3 font-semibold>Ações</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-borda-card">
    @foreach($culturas as $cultura)
    <tr class="hover:bg-fundo-secao transition-colors duration-150">
        <td text-center px-5 py-3 font-medium text-texto-escuro>{{ $cultura->id }}</td>
        <td text-center px-5 py-3 font-medium text-texto-escuro>{{ $cultura->nome }}</td>
        <td text-center px-5 py-3 font-medium text-texto-escuro>{{ $cultura->tipo }}</td>
        <td class="text-center px-5 py-3">
            @if($cultura->imagens->isNotEmpty())
               <img src="{{ Storage::url($cultura->imagens->first()->imagem) }}" alt="Imagem da Cultura" class="w-16 h-16 object-cover rounded-lg">
            @else
                <p class="text-texto-escuro">Nenhuma imagem disponível</p>
             @endif
        </td>
        <td text-center px-5 py-3 font-medium text-texto-escuro>{{ $cultura->localizacao }}</td>
        <td text-center px-5 py-3 font-medium text-texto-escuro>{{ $cultura->data_celebracao }}</td>
        <td text-center px-5 py-3 font-medium text-texto-escuro>
            
        <td class="px-5 py-3 text-center font-medium text-texto-escuro">

            <a href="{{ route('culturas.show', $cultura->id) }}" class="text-primaria hover:text-primaria-dark">Ver mais</a>
            <a href="{{ route('culturas.edit', $cultura->id) }}" class="text-primaria hover:text-primaria-dark">Editar</a>
            
            <form action="{{ route('culturas.destroy', $cultura->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Deseja apagar?')" class="text-primaria hover:text-primaria-dark">Apagar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection