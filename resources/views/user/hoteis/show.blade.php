ja tenho tudo , so quero organizar para nao ficar conforme esta @extends('layouts.user')

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
             GALERIA PRINCIPAL
        ========================= --}}
        @if($hotel->imagens->isNotEmpty())
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 h-96">

                {{-- Imagem principal --}}
                <div class="relative h-full rounded-2xl overflow-hidden cursor-pointer group"
                     onclick="abrirModal({{ $hotel->imagens->first()->id }})">
                    <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         alt="Imagem principal">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                </div>

                {{-- Grid 2x2 --}}
                <div class="grid grid-cols-2 grid-rows-2 gap-3 h-full">
                    @foreach($hotel->imagens->skip(1)->take(4) as $index => $imagem)
                        <div class="relative rounded-xl overflow-hidden cursor-pointer group"
                             onclick="abrirModal({{ $imagem->id }})">
                            <img src="{{ Storage::url($imagem->imagem) }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 alt="Foto {{ $index + 2 }}">
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

                    @for($i = $hotel->imagens->skip(1)->count(); $i < 4; $i++)
                        <div class="bg-gray-200 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400 text-4xl">📷</span>
                        </div>
                    @endfor
                </div>
            </div>

            @if($hotel->imagens->count() > 5)
                <button onclick="abrirModal()"
                        class="mt-3 px-6 py-2 bg-white border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                     Ver todas as {{ $hotel->imagens->count() }} fotos
                </button>
            @endif
        @endif
        <br>

        {{--  DESCRIÇÃO --}}
        <div class="bg-white py-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-texto-escuro px-4">
                {{ $hotel->descricao }}
            </p>
        </div>
        {{--  LOCALIZAÇÃO +  CONTACTO --}}
        <div class="mt-4  gap-10 text-sm ">
            @if($hotel->localizacao || ($hotel->latitude && $hotel->longitude))
                <div>
                    <span class="font-bold block mb-1">Localização:</span>
                    {{ $hotel->localizacao ?? 'Ver no mapa' }}
                    @if($hotel->latitude && $hotel->longitude)
                        <iframe width="400" height="240" class="rounded-lg mt-2 block" loading="lazy"
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
    </div>

    {{-- =========================
         AVALIAÇÕES (INTEGRADO NO SHOW)
    ========================= --}}
    <div class="mt-10">
        <div class="flex items-center justify-between mb-6 border-b pb-2">
            <h2 class="text-2xl font-bold">Avaliações</h2>
            
            {{-- BOTÃO AVALIAR (leva para formulário) --}}
            <a href="{{ route('user.hoteis.avaliar', $hotel->id) }}"
               class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg font-medium transition">
                ⭐ Avaliar Hotel
            </a>
        </div>

        @if($hotel->avaliacoes->count() > 0)
            {{-- MÉDIA --}}
            <div class="mb-4 p-4 bg-amber-50 rounded-xl">
                <p class="text-lg">
                    <span class="font-bold">Média:</span>
                    <span class="text-amber-600 font-bold text-xl">
                        ⭐ {{ number_format($hotel->avaliacoes->avg('nota'), 1) }}/5
                    </span>
                    <span class="text-gray-500 text-sm">({{ $hotel->avaliacoes->count() }} avaliações)</span>
                </p>
            </div>

            {{-- LISTA DE AVALIAÇÕES --}}
            <div class="space-y-4">
                @foreach($hotel->avaliacoes as $avaliacao)
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 font-bold text-sm">
                                    {{ strtoupper(substr($avaliacao->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="font-medium text-gray-800">
                                    {{ $avaliacao->user->name ?? 'Utilizador' }}
                                </span>
                            </div>
                            <div class="text-amber-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    {!! $i <= $avaliacao->nota ? '★' : '<span class="text-gray-300">★</span>' !!}
                                @endfor
                            </div>
                        </div>

                        @if($avaliacao->comentario)
                            <p class="text-gray-600 text-sm mb-2">{{ $avaliacao->comentario }}</p>
                        @endif

                        <small class="text-gray-400 text-xs">
                            {{ $avaliacao->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 bg-gray-50 rounded-xl">
                <p class="text-gray-500 mb-4">Ainda não existem avaliações para este hotel.</p>
                <a href="{{ route('user.hoteis.avaliar', $hotel->id) }}"
                   class="inline-block px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg font-medium transition">
                    ⭐ Seja o primeiro a avaliar
                </a>
            </div>
        @endif
    </div>

    {{-- =========================
         SERVIÇOS
    ========================= --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Serviços</h2>
        @if($hotel->servicos->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($hotel->servicos as $servico)
                    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-2">
                        <span class="text-green-500">✔</span>
                        <span class="text-sm font-medium">{{ $servico->nome }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Nenhum serviço disponível.</p>
        @endif
    </div>

    {{-- =========================
         QUARTOS
    ========================= --}}
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Quartos Disponíveis</h2>
        @if($hotel->quartos->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($hotel->quartos as $quarto)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                        @if($quarto->imagens->isNotEmpty())
                            <img src="{{ asset('storage/' . $quarto->imagens->first()->imagem) }}"
                                 class="w-full h-40 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-bold">{{ $quarto->nome }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ $quarto->descricao }}</p>
                            <p class="font-semibold text-primaria mb-3">{{ $quarto->preco }} Kz</p>
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

{{-- =========================
    🖼️ MODAL DA GALERIA
========================= --}}
<div id="modalGaleria" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center">
    <button onclick="fecharModal()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition z-50">&times;</button>
    
    <div class="relative max-w-5xl max-h-[80vh] px-4">
        <img id="modalImagem" src="" class="max-w-full max-h-[80vh] object-contain rounded-lg">
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/60 text-white px-4 py-1 rounded-full text-sm">
            <span id="contadorAtual">1</span> / <span id="contadorTotal">{{ $hotel->imagens->count() }}</span>
        </div>
    </div>

    <button onclick="imagemAnterior()" class="absolute left-4 text-white text-5xl hover:text-gray-300 transition">&#8249;</button>
    <button onclick="proximaImagem()" class="absolute right-4 text-white text-5xl hover:text-gray-300 transition">&#8250;</button>

    <div class="absolute bottom-0 left-0 right-0 bg-black/80 p-3 overflow-x-auto">
        <div id="thumbnails" class="flex justify-center gap-2"></div>
    </div>
</div>

<script>
    const imagens = @json($hotel->imagens->map(fn($img) => [
        'id' => $img->id,
        'url' => Storage::url($img->imagem)
    ]));

    let indiceAtual = 0;

    function abrirModal(imagemId = null) {
        const modal = document.getElementById('modalGaleria');
        modal.classList.remove('hidden');
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
        document.getElementById('modalImagem').src = imagens[indiceAtual].url;
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
            thumb.className = `h-16 w-16 object-cover rounded cursor-pointer border-2 ${index === indiceAtual ? 'border-white' : 'border-transparent'}`;
            thumb.onclick = () => { indiceAtual = index; atualizarModal(); atualizarThumbnailAtivo(); };
            container.appendChild(thumb);
        });
    }

    function atualizarThumbnailAtivo() {
        const thumbs = document.getElementById('thumbnails').children;
        Array.from(thumbs).forEach((thumb, index) => {
            thumb.className = `h-16 w-16 object-cover rounded cursor-pointer border-2 ${index === indiceAtual ? 'border-white' : 'border-transparent'}`;
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') fecharModal();
        if (e.key === 'ArrowRight') proximaImagem();
        if (e.key === 'ArrowLeft') imagemAnterior();
    });

    document.getElementById('modalGaleria').addEventListener('click', (e) => {
        if (e.target.id === 'modalGaleria') fecharModal();
    });
</script>

@endsection