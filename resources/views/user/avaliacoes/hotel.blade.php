@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-4">

    {{-- CARD --}}
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">

        {{-- HEADER --}}
        <div class="p-8">

            {{-- TÍTULO --}}
            <h1 class="text-3xl font-black text-texto-escuro mb-2">
                Avaliar {{ $hotel->nome }}
            </h1>

            {{-- INFO --}}
            <div class="text-sm text-gray-600 mb-6">
                <span class="font-bold text-gray-800">📍 Localização:</span>
                {{ $hotel->localizacao }}
            </div>

            {{-- ERROS --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST"
                  action="{{ route('user.hoteis.avaliar.store', $hotel->id) }}"
                  class="space-y-6">

                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="Digite o seu email"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3
                               focus:ring-2 focus:ring-amber-400 focus:border-amber-400
                               outline-none transition"
                    >
                </div>

                {{-- NOTA --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Classificação
                    </label>

                    <select
                        name="nota"
                        required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3
                               focus:ring-2 focus:ring-amber-400 focus:border-amber-400
                               outline-none transition"
                    >
                        <option value="">Selecione uma nota</option>
                        <option value="1">⭐ 1 - Muito Mau</option>
                        <option value="2">⭐⭐ 2 - Mau</option>
                        <option value="3">⭐⭐⭐ 3 - Normal</option>
                        <option value="4">⭐⭐⭐⭐ 4 - Bom</option>
                        <option value="5">⭐⭐⭐⭐⭐ 5 - Excelente</option>
                    </select>
                </div>

                {{-- COMENTÁRIO --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Comentário
                    </label>

                    <textarea
                        name="comentario"
                        rows="5"
                        placeholder="Escreva sua opinião..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3
                               focus:ring-2 focus:ring-amber-400 focus:border-amber-400
                               outline-none transition resize-none"
                    >{{ old('comentario') }}</textarea>
                </div>

                {{-- BOTÕES --}}
                <div class="flex items-center gap-4">

                    <button
                        type="submit"
                        class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-6 py-3 rounded-xl shadow-md transition"
                    >
                        ⭐ Enviar Avaliação
                    </button>

                    <a href="{{ route('user.hoteis.show', $hotel->id) }}"
                       class="text-gray-600 hover:text-black font-medium transition">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection