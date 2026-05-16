@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    {{-- BREADCRUMB --}}
    <nav class="flex mb-6 text-sm text-gray-500">
        <a href="{{ route('user.culturas.index') }}" class="hover:text-blue-600 transition">culturas</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">{{ $culturas->nome }}</span>
    </nav>

    {{-- CARD PRINCIPAL --}}
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        
        {{-- IMAGEM PRINCIPAL COM OVERLAY --}}
        <div class="relative group">
            @if($culturas->imagens->isNotEmpty())
                <img src="{{ Storage::url($culturas->imagens->first()->imagem) }}"
                     class="w-full h-80 md:h-96 object-cover transition-transform duration-500 group-hover:scale-105"
                     alt="{{ $culturas->nome }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
            @else
                <div class="w-full h-80 md:h-96 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <div class="p-6 md:p-8">
            
            {{-- TÍTULO E AÇÕES --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-6">
                <h1 class="text-3xl md:text-4xl font-black text-gray-900">
                    {{ $culturas->nome }}
                </h1>
                
                {{-- BOTÃO COMPARTILHAR --}}
                <button onclick="navigator.share ? navigator.share({title: '{{ $culturas->nome }}', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Link copiado!'))"
                        class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-gray-700 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                    </svg>
                    Compartilhar
                </button>
            </div>

            {{-- INFO GRID MELHORADA --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                
                <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-xl">
                    <div class="text-blue-600 text-xl">🏷️</div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Tipo</p>
                        <p class="font-semibold text-gray-800">{{ ucfirst($culturas->tipo) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 bg-green-50 rounded-xl">
                    <div class="text-green-600 text-xl">📍</div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Localização</p>
                        <p class="font-semibold text-gray-800">{{ $culturas->localizacao }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 bg-purple-50 rounded-xl">
                    <div class="text-purple-600 text-xl">📅</div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Data de Celebração</p>
                        <p class="font-semibold text-gray-800">
                            {{ $culturas->data_celebracao ? date('d/m/Y', strtotime($culturas->data_celebracao)) : 'Não definida' }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- ORIGEM ÉTNICA (se existir) --}}
            @if($culturas->origem_etnica)
            <div class="mb-6 p-4 bg-amber-50 rounded-xl border border-amber-100">
                <div class="flex items-center gap-2">
                    <span class="text-amber-600 text-xl">🌍</span>
                    <div>
                        <p class="text-xs text-amber-700 uppercase tracking-wide">Origem Étnica</p>
                        <p class="font-medium text-gray-800">{{ $culturas->origem_etnica }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- DESCRIÇÃO --}}
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                    Sobre esta culturas
                </h2>
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $culturas->descicao ?? 'Sem descrição disponível.' }}
                    </p>
                </div>
            </div>

            {{-- GALERIA DE IMAGENS --}}
            @if($culturas->imagens->count() > 1)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                    Galeria de Imagens ({{ $culturas->imagens->count() }})
                </h2>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($culturas->imagens->skip(1) as $imagem)
                        <div class="relative group cursor-pointer overflow-hidden rounded-lg aspect-square"
                             onclick="openModal('{{ Storage::url($imagem->imagem) }}')">
                            <img src="{{ Storage::url($imagem->imagem) }}"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                 alt="Imagem de {{ $culturas->nome }}">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- BOTÕES DE AÇÃO --}}
            <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('user.culturas.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Voltar para culturas
                </a>
                
             
            </div>

        </div>
    </div>

</div>

{{-- MODAL PARA VISUALIZAR IMAGENS EM TAMANHO COMPLETO --}}
@push('scripts')
<script>
function openModal(imageUrl) {
    // Criar modal dinâmico
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4 cursor-pointer';
    modal.onclick = function(e) {
        if (e.target === modal) modal.remove();
    };
    
    const img = document.createElement('img');
    img.src = imageUrl;
    img.className = 'max-w-full max-h-full object-contain rounded-lg shadow-2xl';
    
    const closeBtn = document.createElement('button');
    closeBtn.innerHTML = '✕';
    closeBtn.className = 'absolute top-4 right-4 text-white text-2xl hover:text-gray-300 transition';
    closeBtn.onclick = () => modal.remove();
    
    modal.appendChild(img);
    modal.appendChild(closeBtn);
    document.body.appendChild(modal);
    
    // Fechar com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') modal.remove();
    }, { once: true });
}
</script>
@endpush

@endsection