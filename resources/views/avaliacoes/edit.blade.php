@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10">   
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Avaliação</h1>

    <form action="{{ route('avaliacoes.update', $avaliacao) }}" method="POST">
        @csrf
        @method('PUT')

            <label for="user_id" class="block text-sm font-semibold text-texto-escuro mb-1">Usuário</label>
            <select name="user_id" id="user_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $avaliacao->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
       

        <div class="mb-3">
            <label for="hotel_id" class="block text-sm font-semibold text-texto-escuro mb-1">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
                <option value="">Nenhum</option>
                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}" {{ $avaliacao->hotel_id == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->nome }}
                    </option>
                @endforeach
            </select>
       
        
            <label for="pontoturistico_id" class="block text-sm font-semibold text-texto-escuro mb-1">Ponto Turístico</label>
            <select name="pontoturistico_id" id="pontoturistico_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
                <option value="">Nenhum</option>
                @foreach($pontos as $ponto)
                    <option value="{{ $ponto->id }}" {{ $avaliacao->pontoturistico_id == $ponto->id ? 'selected' : '' }}>
                        {{ $ponto->nome }}
                    </option>
                @endforeach
            </select>

            <label for="nota" class="block text-sm font-semibold text-texto-escuro mb-1">Nota (0 a 5)</label>
            <input type="number" name="nota" id="nota" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria" min="0" max="5" value="{{ $avaliacao->nota }}" required>

            <label for="comentario" class="block text-sm font-semibold text-texto-escuro mb-1">Comentário</label>
            <textarea name="comentario" id="comentario" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ $avaliacao->comentario }}</textarea>

        <button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button>
        <a href="{{ route('avaliacoes.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Cancelar</a>
    </form>

@endsection