@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Hotel</h1>

    
    {{-- para exibir mensagem de erro --}}
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('hoteis.update', $hotel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <label for="nome" class="block text-sm   font-semibold text-texto-escuro mb-1">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $hotel->nome) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        
            <label for="localizacao" class="block text-sm   font-semibold text-texto-escuro mb-1">Localização</label>
            <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao', $hotel->localizacao) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    
            <label for="descricao" class="block text-sm   font-semibold text-texto-escuro mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" class="border border-borda-card rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ old('descricao', $hotel->descricao) }}</textarea>
        
    
        <label class="block text-sm font-semibold mb-1 mt-3">Latitude</label>
        <input type="text" name="latitude" value="{{ old('latitude', $hotel->latitude) }}"  class="w-full border rounded-lg px-4 py-2">

          <label class="block text-sm font-semibold mb-1 mt-3">Longitude</label>
        <input type="text" name="longitude" value="{{ old('longitude', $hotel->longitude) }}" class="w-full border rounded-lg px-4 py-2">


        {{-- CATEGORIA --}}
        
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
        

            <label for="imagens" class="block text-sm   font-semibold text-texto-escuro mb-1">Imagens (opcional)</label>
            <input type="file" name="imagens[]" id="imagens" multiple class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">

            <label for="contato" class="block text-sm   font-semibold text-texto-escuro mb-1">Contato</label>
            <input type="text" name="contato" id="contato" value="{{ old('contato', $hotel->contato) }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"           >
        

       <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button></center>
    </form>

    {{-- IMAGENS EXISTENTES --}}
<h3 class="font-bold mt-6 mb-2">Imagens do hotel</h3>
<div class="grid grid-cols-3 gap-4 mb-6">
    @foreach($hotel->imagens as $img)
        <div class="border rounded-lg p-2 text-center">
            <img src="{{ Storage::url($img->imagem) }}" class="h-24 w-full object-cover rounded">
            <div class="flex justify-between mt-2 text-sm">
                <form action="{{ route('hoteis.imagens.destroy', [$hotel, $img]) }}" method="POST" onsubmit="return confirm('Remover esta imagem?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600">Remover</button>
                </form>
                <form action="{{ route('hoteis.imagens.principal', [$hotel, $img]) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-primaria">
                        {{ $img->is_principal ? '⭐ Principal' : 'Tornar principal' }}
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

{{-- ADICIONAR NOVAS IMAGENS --}}
<div class="mb-4">
    <label class="block font-bold mb-2">Adicionar novas imagens</label>
    <input type="file" name="imagens[]" multiple accept="image/*">
</div>
<form action="{{ route('hoteis.imagens.destroy', [$hotel, $img]) }}" method="POST" >
    @csrf
    @method('DELETE')
   
</form>
    <a href="{{ route('hoteis.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Voltar</a>

@endsection