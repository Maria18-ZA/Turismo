@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $hotel->nome }}
        </h1>

        <a href="{{ route('hoteis.index') }}"
           class="text-sm text-gray-600 hover:text-black transition">
            ← Voltar
        </a>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-6 space-y-5">

        @php
    $principal = $hotel->imagemPrincipal ?? $hotel->imagens->first();
@endphp
@if($principal)
    <img src="{{ Storage::url($principal->imagem) }}" class="w-full h-64 object-cover rounded">
@endif
        {{-- IMAGEM --}}
        <div>
            @if($hotel->imagens->isNotEmpty())
                <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                     class="w-full h-64 object-cover rounded-xl border border-gray-100">
            @else
                <div class="w-full h-64 flex items-center justify-center bg-gray-50 rounded-xl border border-gray-100 text-gray-400">
                    Sem imagem disponível
                </div>
            @endif
        </div>

        {{-- INFO GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500">ID</p>
                <p class="font-semibold text-gray-900">{{ $hotel->id }}</p>
            </div>

            <div>
                <p class="text-gray-500">Categoria</p>
                <p class="font-semibold text-gray-900">{{ $hotel->categoria ?? '—' }}</p>
            </div>

            <div>
                <p class="text-gray-500">Localização</p>
                <p class="font-semibold text-gray-900">{{ $hotel->localizacao }}</p>
            </div>

            <div>
                <p class="text-gray-500">Contacto</p>
                <p class="font-semibold text-gray-900">{{ $hotel->contato ?? '—' }}</p>
            </div>

        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <p class="text-gray-500 text-sm">Descrição</p>
            <p class="text-gray-800 mt-1 leading-relaxed">
                {{ $hotel->descricao ?? 'Sem descrição' }}
            </p>
        </div>

        

        {{-- DATA --}}
        <div class="text-xs text-gray-400">
            Criado em:
            {{ $hotel->created_at ? $hotel->created_at->format('d/m/Y H:i') : 'Sem data' }}
        </div>

        {{-- AÇÕES --}}
        <div class="flex gap-3 pt-4 border-t border-gray-100">

            <a href="{{ route('hoteis.edit', $hotel) }}"
               class="bg-gray-900 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                Editar
            </a>

            <form action="{{ route('hoteis.destroy', $hotel) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Tens a certeza?')"
                        class="bg-red-50 text-red-600 text-sm px-4 py-2 rounded-lg hover:bg-red-100 transition">
                    Eliminar
                </button>
            </form>

        </div>

    </div>

</div>

@endsection