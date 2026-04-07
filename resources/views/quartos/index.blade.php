@extends('layouts.app')
@section('content')

<h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Quartos</h1>
<a href="{{ route('quartos.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold
               rounded-lg px-5 py-2.5 mb-7
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Novo Quarto</a>

<div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">

<table class="w-full text-sm">
    <thead class="bg-primaria text-white">
    <tr>
        <th class="text-center px-5 py-3 font-semibold">ID</th>
        <th class="text-center px-5 py-3 font-semibold">Número</th>
        <th class="text-center px-5 py-3 font-semibold">Tipo</th>
        <th class="text-center px-5 py-3 font-semibold">Preço</th>
        <th class="text-center px-5 py-3 font-semibold">Ações</th>
    </tr>
    </thead>
   <tbody class="divide-y divide-borda-card">
    @foreach($quartos as $quarto)
    <tr class="hover:bg-fundo-secao transition-colors duration-150">
        <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $quarto->id }}</td>
        <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $quarto->numero }}</td>
        <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $quarto->tipo }}</td>
        <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $quarto->preco }}</td>
        <td class="px-5 py-3 text-center">
            <a href="{{ route('quartos.edit', $quarto->id) }}" class="text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">Editar</a>
            <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST" style="display:inline" class="text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">
                @csrf @method('DELETE')
                <button type="submit" class="text-primaria text-xs  font-bold hover:text-primaria-dark transition-colors">Apagar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection