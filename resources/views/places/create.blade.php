@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria w-fit pb-2">
            Criar Lugar
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Adicione um novo ponto turístico ao sistema
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
    <form action="{{ route('places.store') }}" method="POST"
          class="bg-white border border-borda-card rounded-xl p-6 space-y-5 shadow-sm">

        @csrf

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- TÍTULO --}}
            <div class="md:col-span-2">
                <label class="text-sm font-semibold text-texto-escuro">Título</label>
                <input type="text" name="titulo"
                       value="{{ old('titulo') }}"
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
            </div>

            {{-- CATEGORIA --}}
            <div>
                <label class="text-sm font-semibold text-texto-escuro">Categoria</label>
                <input type="text" name="categoria"
                       value="{{ old('categoria') }}"
                       placeholder="Praia, Hotel, Museu..."
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
            </div>

            {{-- LINK --}}
            <div>
                <label class="text-sm font-semibold text-texto-escuro">Link (opcional)</label>
                <input type="text" name="link"
                       value="{{ old('link') }}"
                       placeholder="https://..."
                       class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
            </div>

        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="text-sm font-semibold text-texto-escuro">Descrição</label>
            <textarea name="descricao" rows="4"
                      class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">{{ old('descricao') }}</textarea>
        </div>

        {{-- IMAGEM --}}
        <div>
            <label class="text-sm font-semibold text-texto-escuro">Imagem (URL)</label>
            <input type="text" name="imagem"
                   value="{{ old('imagem') }}"
                   placeholder="https://..."
                   class="w-full mt-1 border border-borda-card rounded-lg px-4 py-2 focus:ring-2 focus:ring-primaria">
        </div>

        {{-- BOTÕES --}}
        <div class="flex items-center justify-between pt-4">

            <a href="{{ route('places.index') }}"
               class="text-sm text-gray-600 hover:text-primaria">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white text-sm font-bold px-6 py-2.5 rounded-lg hover:bg-primaria-dark transition">
                Guardar Lugar
            </button>

        </div>

    </form>

</div>

@endsection