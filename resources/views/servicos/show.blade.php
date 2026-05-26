@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-4">
        {{ $hotel->nome }}
    </h1>

    <p class="text-sm text-gray-500 mb-4">
        Serviços disponíveis neste hotel
    </p>

    <div class="grid grid-cols-2 gap-3">

        @foreach($hotel->servicos as $servico)
            <div class="border rounded-lg p-3">
                {{ $servico->nome }}
            </div>
        @endforeach

    </div>

    <div class="mt-6 flex gap-3">

        <a href="{{ route('servicos.edit', $hotel) }}"
           class="bg-primaria text-white px-4 py-2 rounded-lg">
            Editar
        </a>

        <a href="{{ route('servicos.index') }}"
           class="px-4 py-2 border rounded-lg">
            Voltar
        </a>

    </div>

</div>

@endsection