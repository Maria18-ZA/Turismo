@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto space-y-10">

    {{-- =========================
        TOPO DO PONTO TURÍSTICO
    ========================= --}}
    <div>

        <h1 class="text-4xl font-black text-texto-escuro">
            {{ $pontoTuristico->nome }}
        </h1>

        {{-- =========================
             GALERIA PRINCIPAL
        ========================= --}}
        @if($pontoTuristico->imagens->isNotEmpty())

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 h-96">

                {{-- Imagem principal --}}
                <div class="relative h-full rounded-2xl overflow-hidden cursor-pointer group"
                     onclick="abrirModal({{ $pontoTuristico->imagens->first()->id }})">

                    <img src="{{ Storage::url($pontoTuristico->imagens->first()->imagem) }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>

                </div>

                {{-- Grid lateral --}}
                <div class="grid grid-cols-2 grid-rows-2 gap-3 h-full">

                    @foreach($pontoTuristico->imagens->skip(1)->take(4) as $index => $imagem)

                        <div class="relative rounded-xl overflow-hidden cursor-pointer group"
                             onclick="abrirModal({{ $imagem->id }})">

                            <img src="{{ Storage::url($imagem->imagem) }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                            @if($index === 3 && $pontoTuristico->imagens->count() > 5)

                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">

                                    <span class="text-white font-bold text-lg">
                                        {{ $pontoTuristico->imagens->count() - 5 }} fotos
                                    </span>

                                </div>

                            @else

                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>

                            @endif

                        </div>

                    @endforeach

                    {{-- Espaços vazios --}}
                    @for($i = $pontoTuristico->imagens->skip(1)->count(); $i < 4; $i++)

                        <div class="bg-gray-200 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400 text-4xl">📷</span>
                        </div>

                    @endfor

                </div>

            </div>

            {{-- Botão ver todas --}}
            @if($pontoTuristico->imagens->count() > 5)

                <button onclick="abrirModal()"
                        class="mt-3 px-6 py-2 bg-white border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">

                    📷 Ver todas as {{ $pontoTuristico->imagens->count() }} fotos

                </button>

            @endif

        @endif


        {{-- =========================
             DESCRIÇÃO
        ========================= --}}
        <div>

            <p class="mt-6 text-texto-escuro leading-relaxed text-base">
                {{ $pontoTuristico->descricao }}
            </p>

        </div>


        {{-- =========================
             LOCALIZAÇÃO
        ========================= --}}
        <div class="mt-4 flex items-start gap-10 text-sm">

            @if($pontoTuristico->localizacao || ($pontoTuristico->latitude && $pontoTuristico->longitude))

                <div>

                    <span class="font-bold block mb-1">
                        Localização
                    </span>

                    {{ $pontoTuristico->localizacao ?? 'Ver no mapa' }}

                    @if($pontoTuristico->latitude && $pontoTuristico->longitude)

                        <iframe
                            width="200"
                            height="120"
                            class="rounded-lg mt-2 block"
                            loading="lazy"
                            src="https://www.google.com/maps?q={{ $pontoTuristico->latitude }},{{ $pontoTuristico->longitude }}&z=15&output=embed">
                        </iframe>

                    @endif

                </div>

            @endif

        </div>

    </div>


    {{-- =========================
        ⭐ BOTÃO AVALIAR
    ========================= --}}
    <div class="my-6">

        <a href="{{ route('user.pontos.avaliar', $pontoTuristico->id) }}"
           class="inline-block px-5 py-3 bg-yellow-500 hover:bg-yellow-600
                  text-white font-bold rounded-xl transition">

            ⭐ Avaliar Ponto Turístico

        </a>

    </div>


    {{-- =========================
        ⭐ AVALIAÇÕES
    ========================= --}}
    <div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Avaliações
        </h2>

        @if($pontoTuristico->avaliacoes->count())

            {{-- Média --}}
            <p class="text-gray-600 mb-6">

                Média:

                <span class="font-bold text-yellow-500">
                    ⭐ {{ number_format($pontoTuristico->avaliacoes->avg('nota'), 1) }}/5
                </span>

            </p>

            {{-- Lista --}}
            <div class="space-y-5">

                @foreach($pontoTuristico->avaliacoes as $avaliacao)

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                        <div class="flex items-center justify-between mb-3">

                            <div>

                                <h3 class="font-bold text-gray-800">
                                    {{ explode('@', $avaliacao->email)[0] }}
                                </h3>

                                <small class="text-gray-400">
                                    {{ $avaliacao->created_at->format('d/m/Y H:i') }}
                                </small>

                            </div>

                            <div class="text-yellow-500 font-bold text-lg">
                                ⭐ {{ $avaliacao->nota }}/5
                            </div>

                        </div>

                        <p class="text-gray-700 leading-relaxed">
                            {{ $avaliacao->comentario }}
                        </p>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-gray-100 rounded-xl p-6 text-center text-gray-500">

                Ainda não existem avaliações para este ponto turístico.

            </div>

        @endif

    </div>


    {{-- =========================
        VOLTAR
    ========================= --}}
    <div>

        <a href="{{ route('user.pontosturisticos.index') }}"
           class="inline-block px-5 py-2 bg-gray-200 hover:bg-gray-300
                  rounded-xl transition font-medium">

             Voltar

        </a>

    </div>

</div>


{{-- =========================
     MODAL GALERIA
========================= --}}
<div id="modalGaleria"
     class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center">

    {{-- Fechar --}}
    <button onclick="fecharModal()"
            class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition z-50">

        &times;

    </button>

    {{-- Imagem --}}
    <div class="relative max-w-5xl max-h-[80vh] px-4">

        <img id="modalImagem"
             src=""
             class="max-w-full max-h-[80vh] object-contain rounded-lg">

        {{-- contador --}}
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/60 text-white px-4 py-1 rounded-full text-sm">

            <span id="contadorAtual">1</span>
            /
            <span id="contadorTotal">
                {{ $pontoTuristico->imagens->count() }}
            </span>

        </div>

    </div>

</div>


<script>

    const imagens = @json($pontoTuristico->imagens->map(fn($img) => [
        'id' => $img->id,
        'url' => Storage::url($img->imagem)
    ]));

    let indiceAtual = 0;

    function abrirModal(imagemId = null)
    {
        const modal = document.getElementById('modalGaleria');

        modal.classList.remove('hidden');

        if (imagemId)
        {
            indiceAtual = imagens.findIndex(img => img.id === imagemId);

            if (indiceAtual === -1)
            {
                indiceAtual = 0;
            }
        }

        atualizarModal();
    }

    function fecharModal()
    {
        document.getElementById('modalGaleria').classList.add('hidden');
    }

    function atualizarModal()
    {
        const img = document.getElementById('modalImagem');

        img.src = imagens[indiceAtual].url;

        document.getElementById('contadorAtual').textContent = indiceAtual + 1;
    }

</script>

@endsection