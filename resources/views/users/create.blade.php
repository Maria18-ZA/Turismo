@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-texto-escuro mb-6">Criar Usuário</h1>

<form action="{{ route('users.store') }}" method="POST">
@csrf
Nome: <input type="text" name="name" value="{{ old('name') }}"><br>
Email: <input type="email" name="email" value="{{ old('email') }}"><br>
Função: <select name="role">
    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="turista" {{ old('role') == 'turista' ? 'selected' : '' }}>Turista</option>
    <option value="gestor" {{ old('role') == 'gestor' ? 'selected' : '' }}>Gestor</option>
</select><br>
Senha: <input type="password" name="password"><br>
<button type="submit">Salvar</button>
</form>

<a href="{{ route('users.index') }}" >Voltar</a>
@endsection