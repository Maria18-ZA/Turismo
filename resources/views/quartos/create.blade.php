@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <h1 class="text-2xl text-center font-bold mb-6">
        Novo Quarto
    </h1>

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
                    <option value="{{ $hotel->id }}">
                        {{ $hotel->nome }}
                    </option>
                @endforeach

            </select>
        </div>

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

        {{-- IMAGEM --}}
        <div>
            <label class="block mb-1 font-semibold">
                Imagem
            </label>

            <input type="file"
                   name="imagem"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Descrição
            </label>

            <textarea name="descricao"
                class="w-full border rounded-lg px-4 py-2">{{ old('descricao') }}</textarea>
        </div>

        {{-- PREÇO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Preço
            </label>

            <input type="text"
                   name="preco"
                   value="{{ old('preco') }}"
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
                Salvar
            </button>

        </div>

    </form>

</div>

@endsection