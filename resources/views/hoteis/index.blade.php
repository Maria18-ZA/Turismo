@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-texto-escuro text-3xl font-black  pb-2 border-b-4 border-primaria-light w-fit">Lista de Hotéis</h1>

    <a href="{{ route('hoteis.create') }}" class="bg-primaria text-white text-sm font-bold
              px-5 py-2.5 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Criar Hotel</a>
</div>

    @if(session('success'))
     <div class="bg-green-50 border border-green-200 text-green-800
                text-sm font-medium px-4 py-3 rounded-lg mb-6">
        <p>{{ session('success') }}</p>
    </div>
    @endif

<div class="bg-white rounded-xl border border-borda-card overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th text-left px-5 py-3 font-semibold>Nome</th>
                <th text-left px-5 py-3 font-semibold>Localização</th>
                <th text-left px-5 py-3 font-semibold>Contato</th>
                <th text-left px-5 py-3 font-semibold>Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-borda-card">
            @forelse($hoteis as $hotel)
                <tr class="hover:bg-fundo-secao transition-colors duration-150">
                    <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $hotel->nome }}</td>
                    <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $hotel->localizacao }}</td>
                    <td class="px-5 py-3 text-center font-medium text-texto-escuro">{{ $hotel->contato }}</td>
                    <td class="px-5 py-3 text-center font-medium text-texto-escuro">


                        <a href="{{ route('hoteis.show', $hotel) }}"  class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Ver mais</a>
                        <a href="{{ route('hoteis.edit', $hotel) }} " class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Editar</a>
                        <form action="{{ route('hoteis.destroy', $hotel) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tens a certeza?')" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-texto-medio">Nenhum hotel encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection