@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-texto-escuro mb-6">Criar Usuário</h1>

<form action="{{ route('users.store') }}" method="POST">
@csrf
Nome: <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br>
Email: <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br>
Função: <select name="role" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria">
    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="turista" {{ old('role') == 'turista' ? 'selected' : '' }}>Turista</option>
    <option value="gestor" {{ old('role') == 'gestor' ? 'selected' : '' }}>Gestor</option>
</select><br>
Senha: <input type="password" name="password" class="w-full border border-borda-card rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primaria"><br>
<button type="submit"class="bg-primaria text-white text-sm font-bold px-5 py-2.5 mt-4 rounded-lg hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200" >Salvar</button>
</form>
<br>
<a href="{{ route('users.index') }}" class="bg-primaria text-white text-sm font-bold
                px-5 py-2.5 m rounded-lg
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200 items-center">Voltar</a>
@endsection