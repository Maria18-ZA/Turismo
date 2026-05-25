@extends('layouts.app')

@section('content')
 <div class="max-w-3xl mx-auto text-texto-escuro">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-texto-escuro">
            Nova Cultura
        </h1>
        <p class="text-sm text-primaria-light mt-1">
            Registe uma nova manifestação cultural no sistema
        </p>
    </div>

    {{-- ERROS --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('culturas.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white border border-borda-card rounded-xl p-6 space-y-5 shadow-sm">

        @csrf

        {{-- Nome --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Nome</label>
            <input type="text" name="nome"
                   class="w-full border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria outline-none"
                   placeholder="Ex: Carnaval de Luanda">
        </div>

        {{-- Tipo --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Tipo</label>
            <select name="tipo"
                    class="w-full border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria outline-none">
                <option value="">Selecione o tipo</option>
                <option value="tradicional">Tradicional</option>
                <option value="moderna">Moderna</option>
            </select>
        </div>

        {{-- IMAGEM --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Imagens</label>

            <input type="file" name="imagem[]" multiple
                   class="w-full border border-borda-card rounded-lg px-4 py-2 bg-white
                          file:bg-primaria file:text-white file:px-4 file:py-2 file:rounded-lg
                          file:border-0 file:cursor-pointer">
            
            <p class="text-xs text-primaria-light mt-1">
                Pode selecionar várias imagens
            </p>
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Descrição</label>
            <textarea name="descicao" rows="4"
                      class="w-full border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria outline-none"
                      placeholder="Descreva a cultura..."></textarea>
        </div>

        {{-- LOCALIZAÇÃO --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Localização</label>
            <input type="text" name="localizacao"
                   class="w-full border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria outline-none"
                   placeholder="Ex: Luanda, Angola">
        </div>

        {{-- DATA --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Data de Celebração</label>
            <input type="date" name="data_celebracao"
                   class="w-full border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria outline-none">
        </div>

        {{-- ORIGEM --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Origem Étnica</label>
            <input type="text" name="origem_etnica"
                   class="w-full border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria outline-none"
                   placeholder="Ex: Kimbundu, Ovimbundu...">
        </div>

        {{-- BOTÃO --}}
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="bg-primaria text-white font-bold px-6 py-2.5 rounded-lg
                           hover:bg-primaria-dark hover:-translate-y-0.5 transition">
                Salvar Cultura
            </button>
        </div>

    </form>

    {{-- VOLTAR --}}
    <div class="mt-6">
        <a href="{{ route('culturas.index') }}"
           class="text-sm text-primaria hover:underline">
            ← Voltar
        </a>
    </div>

</div>

@endsection