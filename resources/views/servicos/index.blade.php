@extends('layouts.app')

@section('content')


    <h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Serviços</h1>

     <a href="{{ route('servicos.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold
               rounded-lg px-5 py-2.5 mb-7
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Criar Serviço</a>

<div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">

    
    <table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th class="text-center px-5 py-3 font-semibold">Hotel</th>
                 <th class="text-center px-5 py-3 font-semibold">Serviço</th>
                <th class="text-center px-5 py-3 font-semibold">Descrição</th>
                <th class="text-center px-5 py-3 font-semibold">Tipo</th>
                <th class="text-center px-5 py-3 font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-borda-card">
            @forelse($servicos as $servico)
                <tr class="hover:bg-fundo-secao transition-colors duration-150">
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $servico->hotel->nome ?? 'Sem hotel' }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $servico->nome }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $servico->descricao }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $servico->tipo }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">

                        
                        <a href="{{ route('servicos.show', $servico) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Ver</a>
                        <a href="{{ route('servicos.edit', $servico) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Editar</a>
                        <form action="{{ route('servicos.destroy', $servico) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-primaria text-xs  font-bold hover:text-primaria-dark transition-colors" onclick="return confirm('Tens a certeza?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum serviço encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection