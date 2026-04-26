@extends('layouts.user')
@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Imagem principal --}}
    @if($hotel->imagens->isNotEmpty())
        <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
             class="w-1/2 h-65 object-cover">
    @endif
            {{--  --}}


    {{-- Dados do card--}}
    <div class="mb-8">
        <h1 class="text-4xl font-black text-texto-escuro border-b-4 border-primaria-light w-fit pb-2">
            {{ $hotel->nome }}
        </h1>

        <p class="text-black-600 mt-2">
            {{ $hotel->descricao }}
        </p>
    </div>
                 {{--  --}}


    {{--GALERIA (NÃO ALTERADA)--}}
    <div>
        <h2 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">
            Galeria de imagens
        </h2>

        @if($hotel->imagens)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                @foreach($hotel->imagens as $imagem)

                    <div class="rounded-2xl">

                        @if($imagem->imagem)
                            <img src="{{ asset('storage/' . $imagem->imagem) }}"
                                 class="w-full h-40 object-cover rounded-xl mb-4">
                        @endif
                    </div>

                @endforeach
            </div>

        @else
            <p class="text-gray-500">Nenhuma imagem disponível.</p>
        @endif
    </div>


    {{-- =========================
        INFORMAÇÕES DO HOTEL
    ========================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg mb-2">Localização</h3>
            <p>{{ $hotel->localizacao   }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg mb-2">Preço Médio</h3>
            <p>{{ $hotel->preco }} Kz</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg mb-2">Contacto</h3>
            <p>{{ $hotel->contacto  }}</p>
        </div>

    </div>


    {{-- =========================
        SERVIÇOS DO HOTEL
    ========================= --}}
    <div class="mb-10">

        <h2 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">
            Serviços
        </h2>

        @if($hotel->servicos->count())

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @foreach($hotel->servicos as $servico)

                    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-2">
                        <span>✔</span>
                        <span class="text-sm font-medium">
                            {{ $servico->nome }}
                        </span>
                    </div>

                @endforeach

            </div>

        @else
            <p class="text-gray-500">Nenhum serviço disponível.</p>
        @endif

    </div>


    {{-- =========================
        QUARTOS DISPONÍVEIS
    ========================= --}}
    <div>

        <h2 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">
            Quartos Disponíveis
        </h2>

        @if($hotel->quartos->count())

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach($hotel->quartos as $quarto)

                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4">

                        @if($quarto->imagem)
                            <img src="{{ asset('storage/' . $quarto->imagem) }}"
                                 class="w-full h-40 object-cover rounded-xl mb-4">
                        @endif

                        <h3 class="text-lg font-bold">
                            {{ $quarto->nome }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-2">
                            {{ $quarto->descricao }}
                        </p>

                        <p class="font-semibold mb-3">
                            {{ $quarto->preco }} Kz
                        </p>

                        <a href="{{ route('user.quartos.show', $quarto->id) }}"
                           class="inline-block bg-primaria text-white px-4 py-2 rounded-xl hover:bg-primaria-dark transition">
                            Ver detalhes
                        </a>

                    </div>

                @endforeach

            </div>

        @else
            <p class="text-gray-500">Nenhum quarto disponível.</p>
        @endif

    </div>

</div>

@endsection