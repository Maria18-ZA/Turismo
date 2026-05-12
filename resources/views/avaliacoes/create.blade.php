@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Nova Avaliação</h1>

    {{-- para exibir mensagem de erro --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('avaliacoes.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="hotel_id" class="block font-medium">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="w-full border rounded p-2">
                <option value=""> Selecione um hotel</option>
                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="pontoturistico_id" class="block font-medium">Ponto Turístico</label>
            <select name="pontoturistico_id" id="pontoturistico_id" class="w-full border rounded p-2">
                <option value="">Selecione um ponto turístico</option>
                @foreach($pontos as $ponto)
                    <option value="{{ $ponto->id }}" {{ old('pontoturistico_id') == $ponto->id ? 'selected' : '' }}>
                        {{ $ponto->nome }}
                    </option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-1">Escolha pelo menos um: hotel ou ponto turístico.</p>
        </div>

        <div>
            <label for="nota" class="block font-medium">Classificação</label>
            <select name="nota" id="nota" required class="w-full border rounded p-2">
                <option value=""> Selecione </option>
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}" {{ old('nota') == $i ? 'selected' : '' }}>
                        {{ str_repeat('⭐', $i) }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <label for="comentario" class="block font-medium">Comentário (opcional)</label>
            <textarea name="comentario" id="comentario" rows="4" class="w-full border rounded p-2" placeholder="Escreva sua opinião...">{{ old('comentario') }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Enviar Avaliação
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('avaliacoes.index') }}" class="text-blue-600 hover:underline"> Voltar</a>
    </div>
</div>
@endsection