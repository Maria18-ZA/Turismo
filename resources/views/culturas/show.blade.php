@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-black text-texto-escuro">
            {{ $cultura->nome }}
        </h1>

        <p class="text-sm text-primaria-light mt-1">
            Detalhes completos da cultura
        </p>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="bg-white border border-borda-card rounded-xl shadow-sm overflow-hidden">

        {{-- IMAGEM --}}
        <div class="w-full h-64 bg-fundo-secao flex items-center justify-center">
            @if($cultura->imagens->isNotEmpty())
                <img src="{{ Storage::url($cultura->imagens->first()->imagem) }}"
                     class="w-full h-full object-cover">
            @else
                <span class="text-primaria-light text-sm">Sem imagem disponível</span>
            @endif
        </div>

        {{-- INFO --}}
        <div class="p-6 space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <p class="text-xs text-primaria-light">ID</p>
                    <p class="font-semibold text-texto-escuro">{{ $cultura->id }}</p>
                </div>

                <div>
                    <p class="text-xs text-primaria-light">Tipo</p>
                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-primaria text-white">
                        {{ $cultura->tipo }}
                    </span>
                </div>

                <div>
                    <p class="text-xs text-primaria-light">Localização</p>
                    <p class="font-semibold text-texto-escuro">
                        {{ $cultura->localizacao }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-primaria-light">Data de Celebração</p>
                    <p class="font-semibold text-texto-escuro">
                        {{ $cultura->data_celebracao ?? '-' }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs text-primaria-light">Descrição</p>
                    <p class="text-texto-escuro leading-relaxed">
                        {{ $cultura->descricao }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-primaria-light">Criado em</p>
                    <p class="font-semibold text-texto-escuro">
                        {{ $cultura->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    {{-- AÇÕES --}}
    <div class="mt-6 flex justify-between items-center">

        <a href="{{ route('culturas.index') }}"
           class="text-primaria hover:underline text-sm">
            ← Voltar
        </a>

        <div class="flex gap-3">

            <a href="{{ route('culturas.edit', $cultura) }}"
               class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition">
                Editar
            </a>

            <form action="{{ route('culturas.destroy', $cultura) }}"
                  method="POST"
                  onsubmit="return confirm('Tens a certeza?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition">
                    Eliminar
                </button>

            </form>

        </div>

    </div>

</div>

@endsection