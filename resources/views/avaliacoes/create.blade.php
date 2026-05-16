@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- TÍTULO --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria-light w-fit pb-2">
            Nova Avaliação
        </h1>
        <p class="text-sm text-texto-medio mt-2">
            Partilhe a sua experiência sobre hotéis ou pontos turísticos.
        </p>
    </div>

    {{-- ERROS --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('avaliacoes.store') }}"
          class="bg-white border border-borda-card rounded-2xl p-6 shadow-sm space-y-5">
        @csrf

        {{-- DESTINO --}}
        <div class="grid md:grid-cols-2 gap-4">

            {{-- HOTEL --}}
            <div>
                <label class="block text-sm font-semibold text-texto-escuro mb-1">
                    Hotel
                </label>
                <select name="hotel_id"
                        class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2">
                    <option value="">Selecione um hotel</option>
                    @foreach($hoteis as $hotel)
                        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                            {{ $hotel->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PONTO TURÍSTICO --}}
            <div>
                <label class="block text-sm font-semibold text-texto-escuro mb-1">
                    Ponto Turístico
                </label>
                <select name="pontoturistico_id"
                        class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2">
                    <option value="">Selecione um ponto</option>
                    @foreach($pontos as $ponto)
                        <option value="{{ $ponto->id }}" {{ old('pontoturistico_id') == $ponto->id ? 'selected' : '' }}>
                            {{ $ponto->nome }}
                        </option>
                    @endforeach
                </select>

                <p class="text-xs text-texto-medio mt-1">
                    Escolha um hotel ou um ponto turístico.
                </p>
            </div>
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">
                Email do avaliador
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="exemplo@email.com"
                   class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2">

            <p class="text-xs text-texto-medio mt-1">
                Usado para identificar a sua avaliação.
            </p>
        </div>

        {{-- NOTA --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-2">
                Classificação
            </label>

            <select name="nota"
                    class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2">
                <option value="">Selecione</option>
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}">
                        {{ str_repeat('⭐', $i) }} {{ $i }}/5
                    </option>
                @endfor
            </select>
        </div>

        {{-- COMENTÁRIO --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">
                Comentário
            </label>

            <textarea name="comentario"
                      rows="4"
                      placeholder="Conte como foi a sua experiência..."
                      class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2"></textarea>
        </div>

        {{-- BOTÃO --}}
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="bg-primaria text-white px-6 py-2.5 rounded-xl font-semibold
                           hover:bg-primaria-dark transition">
                Enviar Avaliação
            </button>
        </div>

    </form>

    {{-- VOLTAR --}}
    <div class="mt-6 text-center">
        <a href="{{ route('avaliacoes.index') }}"
           class="text-primaria hover:text-primaria-dark text-sm font-semibold">
            ← Voltar às avaliações
        </a>
    </div>

</div>
@endsection