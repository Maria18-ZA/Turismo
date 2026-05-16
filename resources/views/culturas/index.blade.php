@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria-light pb-2 w-fit">
        Lista de Culturas
    </h1>

    <a href="{{ route('culturas.create') }}"
       class="bg-primaria text-white text-sm font-bold px-5 py-2.5 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5 transition">
        Criar Cultura
    </a>
</div>

{{-- SUCCESS --}}
@if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- TABLE --}}
<div class="bg-white rounded-xl border border-borda-card overflow-hidden shadow-sm">

    <table class="w-full text-sm">

        <thead class="bg-primaria text-white text-left">
            <tr>
                <th class="px-5 py-3 font-semibold">ID</th>
                <th class="px-5 py-3 font-semibold">Nome</th>
                <th class="px-5 py-3 font-semibold">Tipo</th>
                <th class="px-5 py-3 font-semibold">Imagem</th>
                <th class="px-5 py-3 font-semibold">Localização</th>
                <th class="px-5 py-3 font-semibold">Data</th>
                <th class="px-5 py-3 font-semibold text-center">Ações</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-borda-card">

            @forelse($culturas as $cultura)

                <tr class="hover:bg-fundo-secao transition">

                    <td class="px-5 py-3 text-texto-escuro font-medium">
                        {{ $cultura->id }}
                    </td>

                    <td class="px-5 py-3 text-texto-escuro font-medium">
                        {{ $cultura->nome }}
                    </td>

                    <td class="px-5 py-3">
                        <span class="px-2 py-1 text-xs rounded-full bg-primaria-light text-white">
                            {{ $cultura->tipo }}
                        </span>
                    </td>

                    <td class="px-5 py-3">
                        @if($cultura->imagens->isNotEmpty())
                            <img src="{{ Storage::url($cultura->imagens->first()->imagem) }}"
                                 class="w-14 h-14 object-cover rounded-lg border border-borda-card">
                        @else
                            <span class="text-xs text-primaria-light">Sem imagem</span>
                        @endif
                    </td>

                    <td class="px-5 py-3 text-texto-escuro">
                        {{ $cultura->localizacao }}
                    </td>

                    <td class="px-5 py-3 text-texto-escuro">
                        {{ $cultura->data_celebracao }}
                    </td>

                    {{-- AÇÕES --}}
                    <td class="px-5 py-3">
                        <div class="flex items-center justify-center gap-3 text-sm">

                            <a href="{{ route('culturas.show', $cultura->id) }}"
                               class="text-primaria hover:underline">
                                Ver
                            </a>

                            <a href="{{ route('culturas.edit', $cultura->id) }}"
                               class="text-yellow-600 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('culturas.destroy', $cultura->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja apagar esta cultura?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Apagar
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="text-center py-10 text-primaria-light">
                        Nenhuma cultura encontrada
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

</div>

@endsection