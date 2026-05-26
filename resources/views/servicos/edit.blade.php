@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10">

    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">
        Editar Serviços do Hotel
    </h1>

    @if($errors->any())
        <ul class="mb-4 text-red-500 text-sm">
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('servicos.update', $hotel) }}" method="POST"
          class="bg-white p-6 rounded-lg shadow-md border border-borda-card space-y-6">

        @csrf
        @method('PUT')

        {{-- HOTEL --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Hotel</label>

            <select name="hotel_id"
                    class="w-full border border-borda-card rounded-lg px-4 py-2">

                @foreach($hoteis as $h)
                    <option value="{{ $h->id }}"
                        {{ old('hotel_id', $hotel->id) == $h->id ? 'selected' : '' }}>
                        {{ $h->nome }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- CHECKBOX SERVIÇOS --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Serviços</label>

            <div class="grid grid-cols-2 gap-2">

                @foreach($servicosExistentes as $servico)

                    <label class="flex items-center gap-2 border rounded-lg px-3 py-2">

                        <input type="checkbox"
                               name="servicos[]"
                               value="{{ $servico->nome }}"
                               {{ in_array($servico->nome, $servicosSelecionados ?? []) ? 'checked' : '' }}>

                        <span>{{ $servico->nome }}</span>
                    </label>

                @endforeach

            </div>
        </div>

        {{-- NOVOS SERVIÇOS --}}
        <div>
            <label class="block text-sm font-semibold mb-1">
                Adicionar novos serviços
            </label>

            <input type="text"
                   name="novo_servico"
                   value="{{ old('novo_servico') }}"
                   placeholder="Ex: Spa, Piscina..."
                   class="w-full border rounded-lg px-4 py-2">

            <p class="text-xs text-gray-500 mt-1">
                Separe por vírgulas
            </p>
        </div>

        <button class="bg-primaria text-white px-5 py-2 rounded-lg">
            Atualizar
        </button>

    </form>
</div>

@endsection