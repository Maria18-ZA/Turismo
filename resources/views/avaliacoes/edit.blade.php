@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- TÍTULO --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria-light w-fit pb-2">
            Editar Avaliação
        </h1>
        <p class="text-sm text-texto-medio mt-2">
            Atualize a sua avaliação abaixo.
        </p>
    </div>

    {{-- ERROS --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('avaliacoes.update', $avaliacao) }}"
          class="bg-white border border-borda-card rounded-2xl p-6 shadow-sm space-y-5">
        @csrf
        @method('PUT')

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
                        <option value="{{ $hotel->id }}"
                            {{ old('hotel_id', $avaliacao->hotel_id) == $hotel->id ? 'selected' : '' }}>
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
                        <option value="{{ $ponto->id }}"
                            {{ old('pontoturistico_id', $avaliacao->pontoturistico_id) == $ponto->id ? 'selected' : '' }}>
                            {{ $ponto->nome }}
                        </option>
                    @endforeach
                </select>

                <p class="text-xs text-texto-medio mt-1">
                    Escolha apenas um destino.
                </p>
            </div>
        </div>

        {{-- NOTA --}}
        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-2">
                Classificação
            </label>

            <select name="nota"
                    required
                    class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2">
                <option value="">Selecione</option>
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}"
                        {{ old('nota', $avaliacao->nota) == $i ? 'selected' : '' }}>
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
                      class="w-full rounded-xl border-borda-card focus:border-primaria focus:ring-primaria p-2"
                      placeholder="Atualize a sua opinião...">{{ old('comentario', $avaliacao->comentario) }}</textarea>
        </div>

        {{-- BOTÃO --}}
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="bg-primaria text-white px-6 py-2.5 rounded-xl font-semibold
                           hover:bg-primaria-dark transition">
                Atualizar Avaliação
            </button>
        </div>

    </form>

</div>
@endsection