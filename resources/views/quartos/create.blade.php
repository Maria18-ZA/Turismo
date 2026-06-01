@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold border-b-4 border-primaria w-fit pb-2">
            Criar Quarto
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Adicione um novo quarto
        </p>
    </div>

    {{-- ERROS --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULÁRIO --}}
    <form action="{{ route('quartos.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- HOTEL --}}
        <div>
            <label class="block mb-1 font-semibold">
                Hotel
            </label>

            <select name="hotel_id"
                    class="w-full border rounded-lg px-4 py-2">

                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}"
                        {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->nome }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- NÚMERO --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Número
                </label>

                <input type="text"
                       name="numero"
                       value="{{ old('numero') }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- TIPO --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Tipo
                </label>

                <input type="text"
                       name="tipo"
                       value="{{ old('tipo') }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

        </div>

        {{-- PREÇO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Preço
            </label>

            <input type="number"
                   step="0.01"
                   name="preco"
                   value="{{ old('preco') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Descrição
            </label>

            <textarea name="descricao"
                      rows="4"
                      class="w-full border rounded-lg px-4 py-2">{{ old('descricao') }}</textarea>
        </div>

        {{-- IMAGENS --}}
        <div>
            <label class="block mb-1 font-semibold">
                Imagens
            </label>

            <input type="file"
                   name="imagens[]"
                   multiple
                   accept="image/*"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('quartos.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Criar Quarto
            </button>

        </div>

    </form>

</div>

@endsection