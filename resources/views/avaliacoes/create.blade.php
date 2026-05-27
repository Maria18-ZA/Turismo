@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold border-b-4 border-primaria w-fit pb-2">
            Nova Avaliação
        </h1>

        
    </div>

    {{-- ERROS --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULÁRIO --}}
    <form method="POST"
          action="{{ route('avaliacoes.store') }}"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- DESTINOS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- HOTEL --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Hotel
                </label>

                <select name="hotel_id"
                        class="w-full border rounded-lg px-4 py-2">

                    <option value="">Selecione um hotel</option>

                    @foreach($hoteis as $hotel)

                        <option value="{{ $hotel->id }}"
                            {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>

                            {{ $hotel->nome }}

                        </option>

                    @endforeach

                </select>
            </div>

            {{-- PONTO TURÍSTICO --}}
            <div>
                <label class="block mb-1 font-semibold">
                    Ponto Turístico
                </label>

                <select name="pontoturistico_id"
                        class="w-full border rounded-lg px-4 py-2">

                    <option value="">Selecione um ponto</option>

                    @foreach($pontos as $ponto)

                        <option value="{{ $ponto->id }}"
                            {{ old('pontoturistico_id') == $ponto->id ? 'selected' : '' }}>

                            {{ $ponto->nome }}

                        </option>

                    @endforeach

                </select>

               
            </div>

        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block mb-1 font-semibold">
                Email do Avaliador
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="exemplo@email.com"
                   class="w-full border rounded-lg px-4 py-2">

            
        </div>

        {{-- NOTA --}}
        <div>
            <label class="block mb-1 font-semibold">
                Classificação
            </label>

            <select name="nota"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="">Selecione</option>

                @for($i = 1; $i <= 5; $i++)

                    <option value="{{ $i }}"
                        {{ old('nota') == $i ? 'selected' : '' }}>

                        {{ str_repeat('⭐', $i) }} {{ $i }}/5

                    </option>

                @endfor

            </select>
        </div>

        {{-- COMENTÁRIO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Comentário
            </label>

            <textarea name="comentario"
                      rows="4"
                      placeholder="Conte como foi a sua experiência..."
                      class="w-full border rounded-lg px-4 py-2">{{ old('comentario') }}</textarea>
        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('avaliacoes.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Enviar Avaliação
            </button>

        </div>

    </form>

</div>

@endsection