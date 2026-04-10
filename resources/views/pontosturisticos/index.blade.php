@extends('layouts.app')

@section('content')
    <h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Pontos Turísticos</h1>

    <a href="{{ route('pontosturisticos.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold
               rounded-lg px-5 py-2.5 mb-7
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Criar Ponto Turístico</a>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
     <div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">


<table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th class="text-center px-5 py-3 font-semibold">Nome</th>
                <th class="text-center px-5 py-3 font-semibold">Localização</th>
                <th class="text-center px-5 py-3 font-semibold">Categoria</th>
                <th class="text-center px-5 py-3 font-semibold">Imagem</th>
                <th class="text-center px-5 py-3 font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-borda-card">
            @forelse($pontos as $ponto)
                <tr class="hover:bg-fundo-secao transition-colors duration-150">

                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $ponto->nome }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $ponto->localizacao }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $ponto->categoria }}</td>
                    <td class="text-center px-5 py-3">
                        @if($ponto->imagens->isNotEmpty())
                            <img src="{{ Storage::url($ponto->imagens->first()->imagem) }}" alt="Imagem do Ponto Turístico" class="w-16 h-16 object-cover rounded-lg">
                        @else
                            <p class="text-texto-escuro">Nenhuma imagem disponível</p>
                        @endif
                    </td>
                    <td class="text-center px-5 py-3">

                        <a  href="{{ route('pontosturisticos.show', $ponto) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Ver</a>
                        <a href="{{ route('pontosturisticos.edit', $ponto) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Editar</a>
                        
                        <form action="{{ route('pontosturisticos.destroy', $ponto) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-primaria text-xs  font-bold hover:text-primaria-dark transition-colors">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum ponto turístico encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection