@extends('layouts.app')

@section('content')


<form action="{{ route('servicos.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md border border-borda-card space-y-6">
    @csrf

    {{-- TITULO --}}
    <h1 class="text-2xl font-bold text-texto-escuro text-center mb-4">
        Novo Serviço
    </h1>

    {{-- HOTEL --}}
    <div>
        <label for="hotel_id" class="block text-sm font-semibold text-texto-escuro mb-1">
            Hotel
        </label>

        <select
            name="hotel_id"
            id="hotel_id"
            class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"
        >
            <option value="">Seleciona um hotel</option>

            @foreach($hoteis as $hotel)
                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                    {{ $hotel->nome }}
                </option>
            @endforeach

        </select>
    </div>

    {{-- SERVIÇOS EXISTENTES --}}
    <div>
        <label class="block text-sm font-semibold text-texto-escuro mb-2">
            Serviços Disponíveis
        </label>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

            @foreach($servicosExistentes as $servico)

                <label class="flex items-center gap-2 border border-borda-card rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-50 transition">

                    <input
                        type="checkbox"
                        name="servicos[]"
                        value="{{ $servico->nome }}"
                        class="w-4 h-4 text-primaria"
                    >

                    <span class="text-sm text-texto-escuro">
                        {{ $servico->nome }}
                    </span>

                </label>

            @endforeach

        </div>
    </div>

    {{-- NOVOS SERVIÇOS --}}
    <div>
        <label for="novo_servico" class="block text-sm font-semibold text-texto-escuro mb-1">
            Adicionar novos serviços
        </label>

        <input
            type="text"
            name="novo_servico"
            id="novo_servico"
            value="{{ old('novo_servico') }}"
            placeholder="Ex: Jacuzzi, Sauna, Lavandaria"
            class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"
        >


    </div>

    {{-- BOTÃO --}}
    <div class="text-center pt-2">
        <button
            type="submit"
            class="bg-primaria text-white text-sm font-bold px-6 py-2.5 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200"
        >
            Criar
        </button>
    </div>

</form>
@endsection