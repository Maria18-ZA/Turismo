@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Editar Avaliação</h1>

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

    <form method="POST" action="{{ route('avaliacoes.update', $avaliacao) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="w-full border rounded p-2">
                <option value="">Selecione um hotel</option>
                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id', $avaliacao->hotel_id) == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="pontoturistico_id">Ponto Turístico</label>
            <select name="pontoturistico_id" id="pontoturistico_id" class="w-full border rounded p-2">
                <option value="">Selecione um ponto turístico</option>
                @foreach($pontos as $ponto)
                    <option value="{{ $ponto->id }}" {{ old('pontoturistico_id', $avaliacao->pontoturistico_id) == $ponto->id ? 'selected' : '' }}>
                        {{ $ponto->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="nota">Classificação</label>
            <select name="nota" id="nota" required class="w-full border rounded p-2">
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}" {{ old('nota', $avaliacao->nota) == $i ? 'selected' : '' }}>
                        {{ str_repeat('⭐', $i) }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <label for="comentario">Comentário (opcional)</label>
            <textarea name="comentario" rows="4" class="w-full border rounded p-2">{{ old('comentario', $avaliacao->comentario) }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                Atualizar Avaliação
            </button>
        </div>
    </form>
</div>
@endsection