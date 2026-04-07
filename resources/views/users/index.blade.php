@extends('layouts.app')
@section('content')

<h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Usuários</h1>
<a href="{{ route('users.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold
               rounded-lg px-5 py-2.5 mb-7
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Criar Usuário</a>

<div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">
    
<table class="w-full text-sm">
<thead class="bg-primaria text-white">
<tr>
    <th class="text-center px-5 py-3 font-semibold">ID</th>
    <th class="text-center px-5 py-3 font-semibold">Nome</th>
    <th class="text-center px-5 py-3 font-semibold">Email</th>
    <th class="text-center px-5 py-3 font-semibold">Ações</th>
</tr>
</thead>
<tbody class="divide-y divide-borda-card">
@foreach($users as $user) 
<tr class="hover:bg-fundo-secao transition-colors duration-150">
     
<td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->id }}</td>
<td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->name }}</td>
<td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->email }}</td>
<td class="text-center px-5 py-3 font-medium text-texto-escuro"><!-- Ações: Ver, Editar, Excluir -->

<a href="{{ route('users.show', $user->id) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Ver</a>
<a href="{{ route('users.edit', $user->id) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Editar</a>
<form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')
<button type="submit" class="text-primaria text-xs  font-bold hover:text-primaria-dark transition-colors">Excluir</button>
</form>
</td>
</tr>
@endforeach
</table>