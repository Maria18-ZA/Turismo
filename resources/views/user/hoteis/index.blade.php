@extends('layouts.user')
@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-texto-escuro text-3xl font-black pb-2 border-b-4 border-primaria-light w-fit">
            Hotéis Disponíveis
        </h1>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800
                    text-sm font-medium px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($hoteis as $hotel)

        {{-- CARD --}}
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 
                    hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">

            {{-- IMAGEM --}}
            <div class="relative overflow-hidden">
                @if($hotel->imagens->isNotEmpty())
                    <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                         class="w-full h-48 object-cover transition duration-300 hover:scale-105">
                @endif

                {{-- BADGE (opcional) --}}
                <span class="absolute top-3 left-3 bg-primaria text-white text-xs px-3 py-1 rounded-full">
                    Hotel
                </span>
            </div>

            {{-- CONTEÚDO --}}
            <div class="p-5 flex flex-col flex-1">

                {{-- NOME --}}
                <h2 class="text-lg font-semibold text-texto-escuro">
                    {{ $hotel->nome }}
                </h2>

                {{-- LOCALIZAÇÃO --}}
                <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                    📍 {{ $hotel->localizacao }}
                </p>

                {{-- DESCRIÇÃO --}}
                <p class="text-sm text-gray-600 mt-3 flex-1">
                    {{ Str::limit($hotel->descricao, 90) }}
                </p>

                {{-- BOTÃO --}}
                <a href="{{ route('user.hoteis.show', $hotel->id ) }}"
                   class="mt-4 inline-flex items-center justify-center 
                          bg-primaria text-white px-4 py-2 rounded-lg 
                          text-sm font-semibold hover:bg-primaria-dark 
                          transition">
                    Ver Hotel →
                </a>

            </div>

        </div>

        @empty
            <p>Nenhum hotel disponível.</p>
        @endforelse

    </div>

</div>

@endsection