@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold w-fit pb-2">
            Nova Cultura
        </h1>

        
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
    <form action="{{ route('culturas.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- NOME --}}
        <div>
            <label class="block mb-1 font-semibold">
                Nome
            </label>

            <input type="text"
                   name="nome"
                   value="{{ old('nome') }}"
                   placeholder="Ex: Carnaval de Luanda"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- TIPO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Tipo
            </label>

            <select name="tipo"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="">Selecione o tipo</option>

                <option value="tradicional"
                    {{ old('tipo') == 'tradicional' ? 'selected' : '' }}>
                    Tradicional
                </option>

                <option value="moderna"
                    {{ old('tipo') == 'moderna' ? 'selected' : '' }}>
                    Moderna
                </option>

            </select>
        </div>

        {{-- IMAGENS --}}
        <div>
            <label class="block mb-1 font-semibold">
                Imagens
            </label>

            <input type="file"
                   name="imagem[]"
                   multiple
                   class="w-full border rounded-lg px-4 py-2">

            <p class="text-sm text-gray-500 mt-1">
                Pode selecionar várias imagens
            </p>
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Descrição
            </label>

            <textarea name="descicao"
                      rows="4"
                      placeholder="Descreva a cultura..."
                      class="w-full border rounded-lg px-4 py-2">{{ old('descicao') }}</textarea>
        </div>

        {{-- LOCALIZAÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Localização
            </label>

            <input type="text"
                   name="localizacao"
                   value="{{ old('localizacao') }}"
                   placeholder="Ex: Luanda, Angola"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- DATA --}}
        <div>
            <label class="block mb-1 font-semibold">
                Data de Celebração
            </label>

            <input type="date"
                   name="data_celebracao"
                   value="{{ old('data_celebracao') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- ORIGEM ÉTNICA --}}
        <div>
            <label class="block mb-1 font-semibold">
                Origem Étnica
            </label>

            <input type="text"
                   name="origem_etnica"
                   value="{{ old('origem_etnica') }}"
                   placeholder="Ex: Kimbundu, Ovimbundu..."
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('culturas.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Salvar Cultura
            </button>

        </div>

    </form>

</div>

@endsection