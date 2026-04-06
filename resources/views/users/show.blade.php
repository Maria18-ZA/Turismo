@extends('layouts.app')

@section('content')

<h1>Detalhes do Usuário</h1>

{{-- Mensagem de sucesso --}}
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<p><strong>ID:</strong> {{ $user->id }}</p>

<p><strong>Nome:</strong> {{ $user->name }}</p>

<p><strong>Email:</strong> {{ $user->email }}</p>

<p><strong>Tipo de Usuário:</strong> {{ $user->role }}</p>

<hr>


<a href="{{ route('users.edit', $user->id) }}">Editar</a>

<form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit">Excluir</button>
</form>

<br><br>

<a href="{{ route('users.index') }}">Voltar</a>

@endsection