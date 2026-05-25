 @extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto space-y-10">

    {{-- =========================
        GALERIA + SIDEBAR BOOKING
========================= --}}

@if($hotel->imagens->isNotEmpty())

<div class="mt-5 grid grid-cols-1 xl:grid-cols-4 gap-5">

    {{-- =========================
            GALERIA
    ========================= --}}
    <div class="xl:col-span-3">

        {{-- GRID PRINCIPAL --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 h-[520px]">

            {{-- IMAGEM PRINCIPAL --}}
            <div class="lg:col-span-2 relative rounded-2xl overflow-hidden group cursor-pointer shadow-sm"
                 onclick="abrirModal(0)">

                <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                     alt="Imagem principal">

                <div class="absolute inset-0 bg-black/5 group-hover:bg-black/20 transition duration-300"></div>

            </div>

            {{-- GRID LATERAL --}}
            <div class="lg:col-span-2 grid grid-cols-2 gap-3 h-full">

                @foreach($hotel->imagens->skip(1)->take(4) as $index => $imagem)

                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer shadow-sm"
                         onclick="abrirModal({{ $index + 1 }})">

                        <img src="{{ Storage::url($imagem->imagem) }}"
                             class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                             alt="Foto {{ $index + 2 }}">

                        <div class="absolute inset-0 bg-black/5 group-hover:bg-black/20 transition duration-300"></div>

                        {{-- ÚLTIMA FOTO --}}
                        @if($index === 3 && $hotel->imagens->count() > 5)

                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">

                                <button
                                    class="px-4 py-2 bg-white text-gray-800 rounded-xl
                                           font-semibold shadow-md hover:bg-gray-100 transition">

                                    +{{ $hotel->imagens->count() - 5 }} fotos

                                </button>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>

        {{-- BOTÃO --}}
        <div class="flex justify-end mt-4">

            <button onclick="abrirModal(0)"
                    class="px-5 py-2 bg-white border border-gray-300 rounded-xl
                           text-sm font-semibold hover:bg-gray-100 transition shadow-sm">

                Ver todas as {{ $hotel->imagens->count() }} fotos

            </button>

        </div>

    </div>


    {{-- =========================
            SIDEBAR BOOKING
    ========================= --}}
    <div class="space-y-4">

        {{-- =========================
                SCORE BOOKING
        ========================= --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Excelente
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ number_format($hotel->avaliacoes->avg('nota') ?? 0, 1) }}
                    </h3>

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $hotel->avaliacoes->count() }} avaliações
                    </p>

                </div>

                {{-- QUADRADO AZUL --}}
                <div class="bg-blue-700 text-white font-bold px-3 py-2 rounded-lg text-sm shadow">

                    {{ number_format($hotel->avaliacoes->avg('nota') ?? 0, 1) }}

                </div>

            </div>

            {{-- ESTRELAS --}}
            <div class="flex text-amber-400 mt-4 text-lg">

                @for($i = 1; $i <= 5; $i++)

                    <span>
                        {{ $i <= round($hotel->avaliacoes->avg('nota')) ? '★' : '☆' }}
                    </span>

                @endfor

            </div>

            {{-- BOTÃO --}}
            <a href="#avaliacoes"
               class="mt-4 block text-center bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-semibold py-3 rounded-xl transition">

                Ver avaliações

            </a>

        </div>


        {{-- =========================
                MAPA BOOKING
        ========================= --}}
        @if($hotel->localizacao || ($hotel->latitude && $hotel->longitude))

        <div class="bg-white rounded-2xl py-2 border border-gray-200 overflow-hidden shadow-sm">

            {{-- HEADER --}}
            <div class="p-2 border-b border-gray-100">

                <h3 class="font-semibold text-gray-800">
                    Excelente localização
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $hotel->localizacao ?? 'Ver no mapa' }}
                </p>

            </div>

            {{-- MAPA --}}
            @if($hotel->latitude && $hotel->longitude)

                <iframe
                    width="100%"
                    height="132"
                    class="border-0"
                    loading="lazy"
                    src="https://www.google.com/maps?q={{ $hotel->latitude }},{{ $hotel->longitude }}&z=15&output=embed">
                </iframe>

            @endif

            {{-- FOOTER --}}
            <div class="p-4">

                <a href="https://www.google.com/maps/search/?api=1&query={{ $hotel->latitude }},{{ $hotel->longitude }}"
                   target="_blank"
                   class="block text-center bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-semibold py-2 rounded-xl transition">

                    Ver no mapa

                </a>

            </div>

        </div>

        @endif

    </div>

</div>

@endif


{{-- =========================
        DESCRIÇÃO
========================= --}}
<br>

<div class="bg-white py-10 rounded-xl shadow-sm border border-gray-100">

    <p class="text-texto-escuro px-4">
        {{ $hotel->descricao }}
    </p>

</div>


{{-- =========================
        AVALIAÇÕES
========================= --}}
<div class="mt-10" id="avaliacoes">

    <div class="flex items-center justify-between mb-6 border-b pb-2">

        <h2 class="text-2xl font-bold">
            Avaliações
        </h2>

        <a href="{{ route('user.hoteis.avaliar', $hotel->id) }}"
           class="px-4 py-2 bg-amber-500 hover:bg-amber-600
                  text-white rounded-lg font-medium transition">

            ⭐ Avaliar Hotel

        </a>

    </div>

    @if($hotel->avaliacoes->count() > 0)

        {{-- MÉDIA --}}
        <div class="mb-4 p-4 bg-amber-50 rounded-xl">

            <p class="text-lg">

                <span class="font-bold">
                    Média:
                </span>

                <span class="text-amber-600 font-bold text-xl">

                    ⭐ {{ number_format($hotel->avaliacoes->avg('nota'), 1) }}/5

                </span>

                <span class="text-gray-500 text-sm">
                    ({{ $hotel->avaliacoes->count() }} avaliações)
                </span>

            </p>

        </div>

        {{-- LISTA --}}
        <div class="space-y-4">

            @foreach($hotel->avaliacoes as $avaliacao)

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">

                    <div class="flex items-center justify-between mb-2">

                        <div class="flex items-center gap-2">

                            <div class="w-8 h-8 bg-amber-100 rounded-full
                                        flex items-center justify-center
                                        text-amber-600 font-bold text-sm">

                                {{ strtoupper(substr($avaliacao->user->name ?? 'U', 0, 1)) }}

                            </div>

                            <span class="font-medium text-gray-800">

                                {{ $avaliacao->user->name ?? 'Utilizador' }}

                            </span>

                        </div>

                        {{-- ESTRELAS --}}
                        <div class="text-amber-400 text-sm">

                            @for($i = 1; $i <= 5; $i++)

                                {!! $i <= $avaliacao->nota
                                    ? '★'
                                    : '<span class="text-gray-300">★</span>' !!}

                            @endfor

                        </div>

                    </div>

                    {{-- COMENTÁRIO --}}
                    @if($avaliacao->comentario)

                        <p class="text-gray-600 text-sm mb-2">

                            {{ $avaliacao->comentario }}

                        </p>

                    @endif

                    {{-- DATA --}}
                    <small class="text-gray-400 text-xs">

                        {{ $avaliacao->created_at->format('d/m/Y H:i') }}

                    </small>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center py-8 bg-gray-50 rounded-xl">

            <p class="text-gray-500 mb-4">
                Ainda não existem avaliações para este hotel.
            </p>

            <a href="{{ route('user.hoteis.avaliar', $hotel->id) }}"
               class="inline-block px-4 py-2 bg-amber-500 hover:bg-amber-600
                      text-white rounded-lg font-medium transition">

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
        MODAL BOOKING STYLE
========================= --}}

<div id="modalGaleria"
     class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 hidden items-center justify-center">

    {{-- FECHAR --}}
    <button onclick="fecharModal()"
            class="absolute top-5 right-6 text-white text-5xl font-light hover:text-gray-300 transition z-50">
        &times;
    </button>

    {{-- CONTADOR --}}
    <div class="absolute top-6 left-6 text-white text-sm bg-black/40 px-4 py-2 rounded-full z-50">

        <span id="contadorAtual">1</span>
        /
        <span>{{ $hotel->imagens->count() }}</span>

    </div>

    {{-- BOTÃO ESQUERDA --}}
    <button onclick="imagemAnterior()"
            class="absolute left-5 text-white text-6xl hover:text-gray-300 transition z-50">

        &#8249;

    </button>

    {{-- IMAGEM --}}
    <div class="w-full max-w-6xl px-6">

        <img id="imagemModal"
             src=""
             class="w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl">

    </div>

    {{-- BOTÃO DIREITA --}}
    <button onclick="proximaImagem()"
            class="absolute right-5 text-white text-6xl hover:text-gray-300 transition z-50">

        &#8250;

    </button>

    {{-- THUMBNAILS --}}
    <div class="absolute bottom-0 left-0 right-0 bg-black/70 p-4 overflow-x-auto">

        <div id="thumbnails"
             class="flex justify-center gap-3">

        </div>

    </div>

</div>


{{-- =========================
        JAVASCRIPT
========================= --}}

<script>

    const imagens = @json(
        $hotel->imagens->map(fn($img) => Storage::url($img->imagem))
    );

    let indiceAtual = 0;

    const modal = document.getElementById('modalGaleria');
    const imagemModal = document.getElementById('imagemModal');
    const contadorAtual = document.getElementById('contadorAtual');
    const thumbnails = document.getElementById('thumbnails');


    // ABRIR
    function abrirModal(indice = 0) {

        indiceAtual = indice;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        atualizarGaleria();
    }


    // FECHAR
    function fecharModal() {

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


    // ATUALIZAR
    function atualizarGaleria() {

        imagemModal.src = imagens[indiceAtual];

        contadorAtual.textContent = indiceAtual + 1;

        gerarThumbnails();
    }


    // PRÓXIMA
    function proximaImagem() {

        indiceAtual = (indiceAtual + 1) % imagens.length;

        atualizarGaleria();
    }

    // ANTERIOR
    function imagemAnterior() {

        indiceAtual = (indiceAtual - 1 + imagens.length) % imagens.length;

        atualizarGaleria();
    }

    // THUMBNAILS
    function gerarThumbnails() {

        thumbnails.innerHTML = '';

        imagens.forEach((img, index) => {

            const thumb = document.createElement('img');

            thumb.src = img;

            thumb.className =
                `h-16 w-24 object-cover rounded-xl cursor-pointer border-2 transition duration-300 hover:scale-105
                ${index === indiceAtual
                    ? 'border-white opacity-100'
                    : 'border-transparent opacity-60 hover:opacity-100'
                }`;

            thumb.onclick = () => {

                indiceAtual = index;

                atualizarGaleria();
            };

            thumbnails.appendChild(thumb);
        });
    }

    // TECLADO
    document.addEventListener('keydown', (e) => {

        if (modal.classList.contains('hidden')) return;

        if (e.key === 'Escape') fecharModal();

        if (e.key === 'ArrowRight') proximaImagem();

        if (e.key === 'ArrowLeft') imagemAnterior();
    });

    // FECHAR AO CLICAR FORA
    modal.addEventListener('click', (e) => {

        if (e.target === modal) {
            fecharModal();
        }
    });

</script>
@endsection