@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-4">

    {{-- TÍTULO --}}
    <h1 class="text-4xl font-black text-texto-escuro mb-10 border-b-4 border-primaria-light w-fit pb-2">
        Pontos Turísticos
    </h1>

    {{-- GRID --}}
    @forelse($pontos as $ponto)

        <div class="bg-white shadow-md hover:shadow-xl transition rounded-2xl overflow-hidden mb-6 flex flex-col md:flex-row">

            {{-- IMAGEM --}}
            <div class="md:w-1/3 h-60 bg-gray-100 flex items-center justify-center">

                @if($ponto->imagens->isNotEmpty())
                    <img src="{{ Storage::url($ponto->imagens->first()->imagem) }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="text-gray-400 text-5xl">📷</span>
                @endif

            </div>

            {{-- CONTEÚDO --}}
            <div class="p-6 flex-1 flex flex-col justify-between">

                <div>

                    {{-- NOME --}}
                    <h2 class="text-2xl font-bold text-texto-escuro mb-2">
                        {{ $ponto->nome }}
                    </h2>

                    {{-- INFO --}}
                    <div class="text-sm text-gray-600 space-y-1 mb-4">

                        <p>
                            <span class="font-semibold text-gray-800">📍 Localização:</span>
                            {{ $ponto->localizacao }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-800">🏷 Categoria:</span>
                            {{ $ponto->categoria }}
                        </p>

                    </div>

                    {{-- DESCRIÇÃO (curta opcional) --}}
                    @if($ponto->descricao)
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $ponto->descricao }}
                        </p>
                    @endif

                </div>

                {{-- BOTÃO --}}
                <div class="mt-4">

                    <a href="{{ route('user.pontosturisticos.show', $ponto->id) }}"
                       class="inline-block bg-primaria text-white px-5 py-2.5 rounded-xl
                              font-bold text-sm hover:bg-primaria-dark transition">
                        Ver detalhes
                    </a>

                </div>

            </div>
        </div>

    @empty

        <div class="text-center text-gray-500 py-10">
            Nenhum ponto turístico disponível.
        </div>

    @endforelse

</div>

@endsection