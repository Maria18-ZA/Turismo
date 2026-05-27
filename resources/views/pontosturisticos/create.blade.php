@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">

    <h1 class="text-2xl text-center font-bold mb-6">
        Criar Ponto Turístico
    </h1>

    {{-- ERROS --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pontosturisticos.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- NOME --}}
        <div>
            <label class="block mb-1 font-semibold">Nome</label>
            <input type="text" name="nome" value="{{ old('nome') }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- LOCALIZAÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">Localização</label>
            <input type="text" name="localizacao" value="{{ old('localizacao') }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">Descrição</label>
            <textarea name="descricao"
                class="w-full border rounded-lg px-4 py-2">{{ old('descricao') }}</textarea>
        </div>

        {{-- CATEGORIA --}}
        <div>
            <label class="block mb-1 font-semibold">Categoria</label>

            <select name="categoria" class="w-full border rounded-lg px-4 py-2">

                <option value="">Selecione</option>

                @foreach(['Praia', 'Museu', 'Monumento', 'Parque', 'Outro'] as $categoria)
                    <option value="{{ $categoria }}"
                        {{ old('categoria') == $categoria ? 'selected' : '' }}>
                        {{ $categoria }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- CONTATO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Contato (Opcional)
            </label>

            <input type="text" name="contato" value="{{ old('contato') }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- IMAGEM --}}
        <div>
            <label class="block mb-1 font-semibold">Imagem</label>

            <input type="file" name="imagem"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('pontosturisticos.index') }}"
                class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                class="bg-primaria text-white px-5 py-2 rounded-lg">
                Criar
            </button>

        </div>

    </form>

</div>

@endsection