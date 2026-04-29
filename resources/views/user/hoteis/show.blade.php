@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto space-y-10">

    {{-- =========================
        TOPO DO HOTEL
    ========================= --}}
    <div>

        <h1 class="text-4xl font-black text-texto-escuro">
            {{ $hotel->nome }}
        </h1>

       

        {{-- =========================
            🖼️ GALERIA PRINCIPAL
        ========================= --}}
        @if($hotel->imagens->isNotEmpty())
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 h-96">

                {{-- Imagem principal (maior) --}}
                <div class="relative h-full rounded-2xl overflow-hidden cursor-pointer group"
                     onclick="abrirModal({{ $hotel->imagens->first()->id }})">
                    <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         alt="Imagem principal">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                </div>

                {{-- Grid 2x2 com as próximas 4 fotos --}}
                <div class="grid grid-cols-2 grid-rows-2 gap-3 h-full">

                    @foreach($hotel->imagens->skip(1)->take(4) as $index => $imagem)
                        <div class="relative rounded-xl overflow-hidden cursor-pointer group
                                    {{ $index === 3 && $hotel->imagens->count() > 5 ? 'overflow-hidden' : '' }}"
                             onclick="abrirModal({{ $imagem->id }})">
                            
                            <img src="{{ Storage::url($imagem->imagem) }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 alt="Foto {{ $index + 2 }}">

                            {{-- Overlay "Ver mais" na última foto se houver mais de 5 --}}
                            @if($index === 3 && $hotel->imagens->count() > 5)
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">
                                        +{{ $hotel->imagens->count() - 5 }} fotos
                                    </span>
                                </div>
                            @else
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                            @endif
                        </div>
                    @endforeach

                    {{-- Preenche espaços vazios se tiver menos de 5 fotos --}}
                    @for($i = $hotel->imagens->skip(1)->count(); $i < 4; $i++)
                        <div class="bg-gray-200 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400 text-4xl">📷</span>
                        </div>
                    @endfor

                </div>

            </div>

            {{-- Botão Ver todas as fotos --}}
            @if($hotel->imagens->count() > 5)
                <button onclick="abrirModal()"
                        class="mt-3 px-6 py-2 bg-white border border-gray-300 rounded-xl text-gray-700 
                               hover:bg-gray-50 transition font-medium">
                    📷 Ver todas as {{ $hotel->imagens->count() }} fotos
                </button>
            @endif
      
        {{-- 📝 descrição --}}
        <div>
        <p class=" mt-6 text-texto-escuro  leading-relaxed text-base  gap-6">
            {{ $hotel->descricao }}
        </p>
    </div>

        {{--  📍 localização + 📞 contacto --}}
      <div class="mt-4 flex items-start gap-10 text-sm">

    @if($hotel->localizacao || ($hotel->latitude && $hotel->longitude))
        <div>
            <span class="font-bold block mb-1">Localização:</span>
            {{ $hotel->localizacao ?? 'Ver no mapa' }}
            
            @if($hotel->latitude && $hotel->longitude)
                <iframe
                    width="200"
                    height="120"
                    class="rounded-lg mt-2 block"
                    loading="lazy"
                    src="https://www.google.com/maps?q={{ $hotel->latitude }},{{ $hotel->longitude }}&z=15&output=embed">
                </iframe>
            @endif
        </div>
    @endif

    @if($hotel->contato)
        <div>
            <span class="font-bold block mb-1">Contacto</span>
            {{ $hotel->contato }}
        </div>
    @endif

</div>
    
    @endif

    {{-- =========================
        🧰 SERVIÇOS
    ========================= --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">
            Serviços
        </h2>

        @if($hotel->servicos->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @foreach($hotel->servicos as $servico)
                    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-2">
                        <span class="text-green-500">✔</span>
                        <span class="text-sm font-medium">
                            {{ $servico->nome }}
                        </span>
                    </div>
                @endforeach

            </div>
        @else
            <p class="text-gray-500">Nenhum serviço disponível.</p>
        @endif
    </div>
    

    {{-- =========================
        🛏️ QUARTOS
    ========================= --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">
            Quartos Disponíveis
        </h2>

        @if($hotel->quartos->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach($hotel->quartos as $quarto)

                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                        {{-- imagem --}}
                        @if($quarto->imagem)
                            <img src="{{ asset('storage/' . $quarto->imagem) }}"
                                 class="w-full h-40 object-cover">
                        @endif

                        <div class="p-4">

                            <h3 class="text-lg font-bold">
                                {{ $quarto->nome }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-2">
                                {{ $quarto->descricao }}
                            </p>

                            <p class="font-semibold text-primaria mb-3">
                                {{ $quarto->preco }} Kz
                            </p>

                            <a href="{{ route('user.quartos.show', $quarto->id) }}"
                               class="block text-center bg-primaria text-white px-4 py-2 rounded-xl hover:bg-primaria-dark transition">
                                Ver detalhes
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>
        @else
            <p class="text-gray-500">Nenhum quarto disponível.</p>
        @endif
    </div>

</div>

{{-- ⭐ AVALIAÇÕES --}}
@include('user.hoteis.avaliacoes')

{{-- =========================
    🖼️ MODAL DA GALERIA
========================= --}}
<div id="modalGaleria" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center">

    {{-- Botão fechar --}}
    <button onclick="fecharModal()"
            class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition z-50">
        &times;
    </button>

    {{-- Imagem principal do modal --}}
    <div class="relative max-w-5xl max-h-[80vh] px-4">
        <img id="modalImagem" src="" class="max-w-full max-h-[80vh] object-contain rounded-lg">
        
        {{-- Contador --}}
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/60 text-white px-4 py-1 rounded-full text-sm">
            <span id="contadorAtual">1</span> / <span id="contadorTotal">{{ $hotel->imagens->count() }}</span>
        </div>
    </div>

    {{-- Setas navegação --}}
    <button onclick="imagemAnterior()"
            class="absolute left-4 text-white text-5xl hover:text-gray-300 transition">
        &#8249;
    </button>
    <button onclick="proximaImagem()"
            class="absolute right-4 text-white text-5xl hover:text-gray-300 transition">
        &#8250;
    </button>

    {{-- Thumbnails em baixo --}}
    <div class="absolute bottom-0 left-0 right-0 bg-black/80 p-3 overflow-x-auto">
        <div id="thumbnails" class="flex justify-center gap-2">
            {{-- Preenchido via JS --}}
        </div>
    </div>

</div>

<script>
    // Dados das imagens
    const imagens = @json($hotel->imagens->map(fn($img) => [
        'id' => $img->id,
        'url' => Storage::url($img->imagem)
    ]));

    let indiceAtual = 0;

    function abrirModal(imagemId = null) {
        const modal = document.getElementById('modalGaleria');
        modal.classList.remove('hidden');

        // Se clicou numa imagem específica, encontra o índice
        if (imagemId) {
            indiceAtual = imagens.findIndex(img => img.id === imagemId);
            if (indiceAtual === -1) indiceAtual = 0;
        }

        atualizarModal();
        gerarThumbnails();
    }

    function fecharModal() {
        document.getElementById('modalGaleria').classList.add('hidden');
    }

    function atualizarModal() {
        const img = document.getElementById('modalImagem');
        img.src = imagens[indiceAtual].url;
        document.getElementById('contadorAtual').textContent = indiceAtual + 1;
    }

    function proximaImagem() {
        indiceAtual = (indiceAtual + 1) % imagens.length;
        atualizarModal();
        atualizarThumbnailAtivo();
    }

    function imagemAnterior() {
        indiceAtual = (indiceAtual - 1 + imagens.length) % imagens.length;
        atualizarModal();
        atualizarThumbnailAtivo();
    }

    function gerarThumbnails() {
        const container = document.getElementById('thumbnails');
        container.innerHTML = '';

        imagens.forEach((img, index) => {
            const thumb = document.createElement('img');
            thumb.src = img.url;
            thumb.className = `h-16 w-16 object-cover rounded cursor-pointer border-2 
                              ${index === indiceAtual ? 'border-white' : 'border-transparent'}`;
            thumb.onclick = () => {
                indiceAtual = index;
                atualizarModal();
                atualizarThumbnailAtivo();
            };
            container.appendChild(thumb);
        });
    }

    function atualizarThumbnailAtivo() {
        const thumbs = document.getElementById('thumbnails').children;
        Array.from(thumbs).forEach((thumb, index) => {
            thumb.className = `h-16 w-16 object-cover rounded cursor-pointer border-2 
                              ${index === indiceAtual ? 'border-white' : 'border-transparent'}`;
        });
    }

    // Fechar com ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') fecharModal();
        if (e.key === 'ArrowRight') proximaImagem();
        if (e.key === 'ArrowLeft') imagemAnterior();
    });

    // Fechar ao clicar fora
    document.getElementById('modalGaleria').addEventListener('click', (e) => {
        if (e.target.id === 'modalGaleria') fecharModal();
    });
</script>

@endsection