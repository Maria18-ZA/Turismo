@extends('layouts.app')

@section('content')

@php
    $userAuth = auth()->user();
    $isAdmin = $userAuth->role === 'admin';
@endphp

<h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Usuários</h1>

@if($isAdmin)
    <a href="{{ route('users.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold
               rounded-lg px-5 py-2.5 mb-7
               hover:bg-primaria-dark hover:-translate-y-0.5
               transition-all duration-200 inline-block">
        Criar Usuário
    </a>
@endif

{{-- ALERTA --}}
@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">
        {{ $errors->first() }}
    </div>
@endif

<div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th class="text-center px-5 py-3 font-semibold">ID</th>
                <th class="text-center px-5 py-3 font-semibold">Nome</th>
                <th class="text-center px-5 py-3 font-semibold">Email</th>
                <th class="text-center px-5 py-3 font-semibold">Contato</th>
                <th class="text-center px-5 py-3 font-semibold">Função</th>
                <th class="text-center px-5 py-3 font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-borda-card">
            @forelse($users as $user)
                <tr class="hover:bg-fundo-secao transition-colors duration-150">
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->id }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->name }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->email }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $user->contato }}</td>
                    <td class="text-center px-5 py-3">
                        <span class="inline-flex items-center px-2 py-1 text-xs rounded-full font-semibold
                            @if($user->role === 'admin') bg-red-100 text-red-700
                            @elseif($user->role === 'gestor') bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="text-center px-5 py-3 space-x-2">
                        <a href="{{ route('users.show', $user->id) }}" 
                           class="text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">Ver</a>
                        <a href="{{ route('users.edit', $user->id) }}" 
                           class="text-primaria text-xs font-bold hover:text-primaria-dark transition-colors">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline" 
                              onsubmit="return confirm('Tem certeza que deseja eliminar este utilizador?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 text-xs font-bold hover:text-red-800 transition-colors">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        Nenhum utilizador encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection