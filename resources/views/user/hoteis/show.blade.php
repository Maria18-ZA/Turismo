@extends('layouts.user')
@section('content')
<div class="max-w-6xl mx-auto">

    {{-- TÍTULO --}}
    <div class="mb-8">
        <h1 class="text-4xl font-black text-texto-escuro border-b-4 border-primaria-light w-fit pb-2">
            {{ $hotel->nome }}
        </h1>
        <p class="text-gray-600 mt-2">
            {{ $hotel->descricao }}
        </p>
    </div>

    {{-- IMAGEM (se tiveres) --}}
    @if($hotel->imagem)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $hotel->imagem) }}" 
                 class="w-full h-96 object-cover rounded-2xl shadow">
        </div>
    @endif

    {{-- INFORMAÇÕES --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg mb-2">Localização</h3>
            <p>{{ $hotel->localizacao ?? 'Não informado' }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg mb-2">Preço Médio</h3>
            <p>{{ $hotel->preco ?? '---' }} Kz</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg mb-2">Contacto</h3>
            <p>{{ $hotel->contacto ?? '---' }}</p>
        </div>

    </div>

    {{-- QUARTOS --}}
    <div>
        <h2 class="text-2xl font-bold mb-6 border-b-2 border-gray-200 pb-2">
            Quartos Disponíveis
        </h2>

        @if($hotel->quartos->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach($hotel->quartos as $quarto)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4">

                        {{-- imagem do quarto --}}
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
