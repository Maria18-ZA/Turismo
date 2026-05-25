@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto text-texto-escuro">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria w-fit pb-2">
            Criar Hotel
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Adicione um novo hotel ao sistema
        </p>
    </div>

    {{-- ERROS --}}
    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('hoteis.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white border border-borda-card rounded-xl p-6 space-y-5 shadow-sm">

        @csrf

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="text-sm font-semibold text-texto-escuro">Nome do Hotel</label>
                <input type="text" name="nome"
                       value="{{ old('nome') }}"
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
            </div>

            <div>
                <label class="text-sm font-semibold text-texto-escuro">Localização</label>
                <input type="text" name="localizacao"
                       value="{{ old('localizacao') }}"
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
            </div>

            <div>
                <label class="text-sm font-semibold text-texto-escuro">Latitude</label>
                <input type="text" name="latitude"
                       value="{{ old('latitude') }}"
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2">
            </div>

            <div>
                <label class="text-sm font-semibold text-texto-escuro">Longitude</label>
                <input type="text" name="longitude"
                       value="{{ old('longitude') }}"
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2">
            </div>

        </div>

        {{-- CATEGORIA (CORRIGIDA) --}}
        <div>
            <label class="text-sm font-semibold text-texto-escuro">Categoria</label>

            <select name="categoria"
                    class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">

                <option value="">Selecione a categoria</option>
                <option value="3_estrelas">3 Estrelas</option>
                <option value="4_estrelas">4 Estrelas</option>
                <option value="5_estrelas">5 Estrelas</option>
                <option value="luxo">Luxo</option>
                <option value="resort">Resort</option>
                <option value="outro">Outro</option>

            </select>
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="text-sm font-semibold text-texto-escuro">Descrição</label>
            <textarea name="descricao" rows="4"
                      class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
                {{ old('descricao') }}
            </textarea>
        </div>

        {{-- CONTATO --}}
        <div>
            <label class="text-sm font-semibold text-texto-escuro">Contato</label>
            <input type="text" name="contato"
                   value="{{ old('contato') }}"
                   class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
        </div>

        {{-- IMAGENS --}}
        <div>
            <label class="text-sm font-semibold text-texto-escuro">Imagens</label>
            <input type="file" name="imagens[]" multiple
                   class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 bg-gray-50">
        </div>

        {{-- BOTÕES --}}
        <div class="flex items-center justify-between pt-4">

            <a href="{{ route('hoteis.index') }}"
               class="text-sm text-gray-600 hover:text-primaria">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white text-sm font-bold px-6 py-2.5 rounded-lg hover:bg-primaria-dark transition">
                Criar Hotel
            </button>

        </div>

    </form>

</div>

@endsection