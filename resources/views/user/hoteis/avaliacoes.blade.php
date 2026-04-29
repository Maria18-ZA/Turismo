{{-- =========================
    SISTEMA DE AVALIAÇÃO - INTEGRADO
========================= --}}
<div class="mt-10 space-y-6">

    {{-- Header com média e total --}}
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-texto-escuro flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Avaliações
        </h2>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1 text-yellow-400 text-xl">
                @php
                    $media = $hotel->avaliacoes->avg('estrela') ?? 0;
                    $total = $hotel->avaliacoes->count();
                @endphp
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($media))
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </div>
            <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                {{ number_format($media, 1) }} ({{ $total }} avaliações)
            </span>
        </div>
    </div>

    {{-- Formulário de avaliação --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-texto-escuro mb-4">Deixe sua avaliação</h3>

        <form action="{{ route('user.avaliacoes.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

            {{-- Estrelas interativas --}}
            <div class="flex items-center gap-3">
                <label class="text-sm font-medium text-gray-600">Sua nota:</label>
                <div class="flex gap-1" id="estrelas-container">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" 
                                onclick="selecionarEstrela({{ $i }})"
                                onmouseenter="hoverEstrela({{ $i }})"
                                onmouseleave="resetEstrelas()"
                                class="estrela-btn text-3xl text-gray-300 hover:scale-110 transition-all focus:outline-none cursor-pointer"
                                data-valor="{{ $i }}">
                            ★
                        </button>
                    @endfor
                </div>
                <input type="hidden" name="estrela" id="estrelas-input" value="0" required>
                <span id="estrela-texto" class="text-sm font-medium text-primaria ml-2"></span>
            </div>

            {{-- Comentário --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Comentário (opcional)</label>
                <textarea name="comentario" rows="3" 
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primaria resize-none"
                          placeholder="Conte sua experiência neste hotel...">{{ old('comentario') }}</textarea>
            </div>

            <button type="submit" 
                    class="bg-primaria text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-primaria-dark transition-colors shadow-sm">
                Enviar avaliação
            </button>
        </form>
    </div>

    {{-- Lista de avaliações --}}
    <div class="space-y-4">
        @forelse($hotel->avaliacoes()->latest()->take(10)->get() as $avaliacao)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        {{-- Avatar com inicial --}}
                        <div class="w-10 h-10 bg-primaria/10 rounded-full flex items-center justify-center text-primaria font-bold text-sm">
                            {{ strtoupper(substr($avaliacao->user?->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-texto-escuro text-sm">
                                {{ $avaliacao->user?->name ?? 'Visitante' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $avaliacao->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    {{-- Estrelas da avaliação --}}
                    <div class="flex text-yellow-400 text-lg">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $avaliacao->estrela)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                </div>

                @if($avaliacao->comentario)
                    <p class="mt-3 text-gray-600 text-sm leading-relaxed pl-13">
                        {{ $avaliacao->comentario }}
                    </p>
                @endif
            </div>
        @empty
            <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                <p class="text-3xl mb-2">⭐</p>
                <p class="text-gray-500 font-medium">Nenhuma avaliação ainda.</p>
                <p class="text-gray-400 text-sm mt-1">Seja o primeiro a avaliar este hotel!</p>
            </div>
        @endforelse
    </div>

</div>

<script>
    const estrelasInput = document.getElementById('estrelas-input');
    const estrelaTexto = document.getElementById('estrela-texto');
    const botoes = document.querySelectorAll('.estrela-btn');

    const textos = {
        1: 'Péssimo',
        2: 'Ruim', 
        3: 'Bom',
        4: 'Muito bom',
        5: 'Excelente'
    };

    function selecionarEstrela(valor) {
        estrelasInput.value = valor;
        atualizarEstrelas(valor);
        estrelaTexto.textContent = textos[valor];
    }

    function hoverEstrela(valor) {
        atualizarEstrelas(valor);
        estrelaTexto.textContent = textos[valor];
    }

    function resetEstrelas() {
        const selecionado = parseInt(estrelasInput.value);
        atualizarEstrelas(selecionado);
        estrelaTexto.textContent = selecionado > 0 ? textos[selecionado] : '';
    }

    function atualizarEstrelas(valor) {
        botoes.forEach((btn, index) => {
            const btnValor = index + 1;
            if (btnValor <= valor) {
                btn.classList.remove('text-gray-300');
                btn.classList.add('text-yellow-400');
            } else {
                btn.classList.remove('text-yellow-400');
                btn.classList.add('text-gray-300');
            }
        });
    }
</script>