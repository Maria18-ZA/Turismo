@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Quarto</h1>

    {{-- Exibir mensagens de erro --}}
    @if($errors->any())
        <ul class="text-red-600 mb-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('quartos.update', $quarto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="hotel_id" class="block text-sm font-semibold text-texto-escuro mb-1">Hotel</label>
        <select name="hotel_id" id="hotel_id"
                class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria mb-4">
            @foreach($hoteis as $hotel)
                <option value="{{ $hotel->id }}" {{ old('hotel_id', $quarto->hotel_id) == $hotel->id ? 'selected' : '' }}>
                    {{ $hotel->nome }}
                </option>
            @endforeach
        </select>

        <label for="numero" class="block text-sm font-semibold text-texto-escuro mb-1">Número</label>
        <input type="text" name="numero" id="numero" value="{{ old('numero', $quarto->numero) }}"
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria mb-4">

        <label for="tipo" class="block text-sm font-semibold text-texto-escuro mb-1">Tipo</label>
        <input type="text" name="tipo" id="tipo" value="{{ old('tipo', $quarto->tipo) }}"
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria mb-4">

        <label for="preco" class="block text-sm font-semibold text-texto-escuro mb-1">Preço</label>
        <input type="text" name="preco" id="preco" value="{{ old('preco', $quarto->preco) }}"
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria mb-4">

        <label for="descricao" class="block text-sm font-semibold text-texto-escuro mb-1">Descrição</label>
        <textarea name="descricao" id="descricao"
                  class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria mb-4">{{ old('descricao', $quarto->descricao) }}</textarea>

        <label for="imagens" class="block text-sm font-semibold text-texto-escuro mb-1">Imagens (opcional)</label>
        <input type="file" name="imagens[]" id="imagens" multiple accept="image/*"
               class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria mb-4">

        <center>
            <button type="submit"
                    class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">
                Atualizar
            </button>
        </center>
    </form>

    {{-- IMAGENS EXISTENTES --}}
    <h3 class="font-bold mt-6 mb-2">Imagens do quarto</h3>
    <div class="grid grid-cols-3 gap-4 mb-6">
        @foreach($quarto->imagens as $img)
            <div class="border rounded-lg p-2 text-center">
                <img src="{{ Storage::url($img->imagem) }}" class="h-24 w-full object-cover rounded">
                <div class="flex justify-between mt-2 text-sm">
                    <form action="{{ route('quartos.imagens.destroy', [$quarto, $img]) }}" method="POST" onsubmit="return confirm('Remover esta imagem?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Remover</button>
                    </form>
                    <form action="{{ route('quartos.imagens.principal', [$quarto, $img]) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-primaria">
                            {{ $img->is_principal ? '⭐ Principal' : 'Tornar principal' }}
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('quartos.index') }}"
       class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-20 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">
        Voltar
    </a>
</div>

@endsection