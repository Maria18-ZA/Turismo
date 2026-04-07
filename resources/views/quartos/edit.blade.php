@extends('layouts.app')
@section('content')


<div class="max-w-2xl mx-auto mt-10">

<h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Quarto</h1>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('quartos.update', $quarto->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Hotel:</label>
    <select name="hotel_id" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
        @foreach($hoteis as $hotel)
            <option value="{{ $hotel->id }}" @if($quarto->hotel_id == $hotel->id) selected @endif>{{ $hotel->nome }}</option>
        @endforeach
    </select><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1"> Número:</label>
    <input type="text" name="numero" value="{{ $quarto->numero }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Tipo:</label>
    <input type="text" name="tipo" value="{{ $quarto->tipo }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Preço:</label>
    <input type="text" name="preco" value="{{ $quarto->preco }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br><br>

    <label class="block text-sm   font-semibold text-texto-escuro mb-1">Descrição:</label>
    <textarea name="descricao" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">{{ $quarto->descricao }}</textarea><br><br>

    
    <center><button type="submit" class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">Atualizar</button></center>
</form>
<a href="{{ route('quartos.index') }}" class="fixed top-4 right-4 bg-primaria text-white text-sm font-bold
                px-5 py-2.5 mt-20 rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 ">Voltar</a>
@endsection