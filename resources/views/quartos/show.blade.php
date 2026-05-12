@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-xl border border-borda-card overflow-hidden">
        
        {{-- Cabeçalho --}}
        <div class="bg-primaria px-6 py-4">
            <h1 class="text-xl font-bold text-white">Quarto {{ $quarto->id }}</h1>
            <p class="text-amber-100 text-sm mt-1">{{ $quarto->tipo }}</p>
        </div>

        {{-- Conteúdo --}}
        <div class="p-6 space-y-4">
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Número:</strong> {{ $quarto->numero }}</p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Tipo:</strong> {{ $quarto->tipo }}</p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Preço:</strong> 
                    <span class="text-primaria font-bold">{{ number_format($quarto->preco, 2) }} kz</span>
                </p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Disponível:</strong> 
                    <span class="{{ $quarto->disponivel ? 'text-green-600' : 'text-red-600' }}">
                        {{ $quarto->disponivel ? 'Sim' : 'Não' }}
                    </span>
                </p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Imagem:</strong></p>
                @if($quarto->imagens->isNotEmpty())
                    <img src="{{ Storage::url($quarto->imagens->first()->imagem) }}" 
                         alt="Imagem do Quarto" 
                         class="mt-2 w-32 h-32 object-cover rounded-lg border border-borda-card">
                @else
                    <p class="text-gray-500 italic mt-1">Nenhuma imagem disponível</p>
                @endif
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Criado em:</strong> {{ $quarto->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        {{-- Botões --}}
        <div class="bg-gray-50 px-6 py-4 border-t border-borda-card flex gap-3">
            <a href="{{ route('quartos.index') }}" 
               class="bg-gray-500 text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-gray-600 transition-all duration-200">
                 Voltar
            </a>
            
            <a href="{{ route('quartos.edit', $quarto) }}" 
               class="bg-yellow-500 text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-yellow-600 transition-all duration-200">
                 Editar
            </a>
            
            <form action="{{ route('quartos.destroy', $quarto) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-red-600 transition-all duration-200"
                        onclick="return confirm('Tem certeza que deseja eliminar este quarto?')">
                     Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection