@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold border-b-4 border-primaria w-fit pb-2">
            Criar Hotel
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Adicione um novo hotel
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
    <form action="{{ route('hoteis.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- NOME --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Nome do Hotel
                </label>

                <input type="text"
                       name="nome"
                       value="{{ old('nome') }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- LOCALIZAÇÃO --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Localização
                </label>

                <input type="text"
                       name="localizacao"
                       value="{{ old('localizacao') }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- LATITUDE --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Latitude
                </label>

                <input type="text"
                       name="latitude"
                       value="{{ old('latitude') }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- LONGITUDE --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Longitude
                </label>

                <input type="text"
                       name="longitude"
                       value="{{ old('longitude') }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

        </div>

        {{-- CATEGORIA --}}
        <div>
            <label class="block mb-1 font-semibold">
                Categoria
            </label>

            <select name="categoria"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="">Selecione</option>

                @foreach([
                    '3_estrelas' => '3 Estrelas',
                    '4_estrelas' => '4 Estrelas',
                    '5_estrelas' => '5 Estrelas',
                    'luxo' => 'Luxo',
                    'resort' => 'Resort',
                    'outro' => 'Outro'
                ] as $valor => $texto)

                    <option value="{{ $valor }}"
                        {{ old('categoria') == $valor ? 'selected' : '' }}>
                        {{ $texto }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Descrição
            </label>

            <textarea name="descricao" rows="4"
                class="w-full border rounded-lg px-4 py-2">{{ old('descricao') }}</textarea>
        </div>

        {{-- CONTATO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Contato
            </label>

            <input type="text"
                   name="contato"
                   value="{{ old('contato') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- IMAGENS --}}
        <div>
            <label class="block mb-1 font-semibold">
                Imagens
            </label>

            <input type="file"
                   name="imagens[]"
                   multiple
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('hoteis.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Criar Hotel
            </button>

        </div>

    </form>

</div>

@endsection