@extends('layouts.app')

@section('title', 'Meu Perfil')
@section('breadcrumb', 'Perfil do Utilizador')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    {{-- CABEÇALHO DO PERFIL --}}
    <div class="flex items-center gap-6 bg-white rounded-xl border border-borda-card p-6 shadow-sm">
        <div class="w-24 h-24 rounded-full bg-primaria flex items-center justify-center text-white text-3xl font-bold shadow-md">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div>
            <h1 class="text-3xl font-black text-texto-escuro">{{ $user->name }}</h1>
            <div class="flex items-center gap-3 mt-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                    @if($user->role === 'admin') bg-red-100 text-red-700
                    @elseif($user->role === 'gestor') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ ucfirst($user->role) }}
                </span>
                <span class="text-gray-500 text-sm">{{ $user->email }}</span>
            </div>
            <p class="text-gray-500 text-sm mt-2">
                Membro desde {{ $user->created_at->format('d/m/Y') }}
            </p>
        </div>
    </div>

    {{-- ALERTAS --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ESTATÍSTICAS (INTELIGENTES) --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-borda-card p-4 text-center">
            <p class="text-xs text-gray-500">Reservas</p>
            <p class="text-2xl font-black text-primaria">{{ $totalReservas }}</p>
        </div>
        <div class="bg-white rounded-xl border border-borda-card p-4 text-center">
            <p class="text-xs text-gray-500">Avaliações</p>
            <p class="text-2xl font-black text-primaria">{{ $totalAvaliacoes }}</p>
        </div>
        @if($user->role === 'gestor')
            <div class="bg-white rounded-xl border border-borda-card p-4 text-center">
                <p class="text-xs text-gray-500">Hotéis</p>
                <p class="text-2xl font-black text-primaria">{{ $totalHoteis }}</p>
            </div>
            <div class="bg-white rounded-xl border border-borda-card p-4 text-center">
                <p class="text-xs text-gray-500">Quartos</p>
                <p class="text-2xl font-black text-primaria">{{ $totalQuartos }}</p>
            </div>
            <div class="col-span-2 lg:col-span-1 bg-white rounded-xl border border-borda-card p-4 text-center">
                <p class="text-xs text-gray-500">Reservas nos seus Hotéis</p>
                <p class="text-2xl font-black text-primaria">{{ $totalReservasGestor }}</p>
            </div>
        @endif
    </div>

    {{-- ÚLTIMAS ACTIVIDADES --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Últimas Reservas --}}
        <div class="bg-white rounded-xl border border-borda-card p-5">
            <h2 class="font-bold text-texto-escuro border-b pb-2 mb-3">Últimas Reservas</h2>
            @if($ultimasReservas->count())
                <ul class="space-y-3">
                    @foreach($ultimasReservas as $reserva)
                        <li class="text-sm flex justify-between items-center">
                            <span>
                                @if($user->role === 'gestor')
                                    <span class="font-medium">{{ $reserva->user->name ?? 'Cliente' }}</span> –
                                @endif
                                <span class="text-gray-600">{{ $reserva->hotel->nome ?? 'Hotel' }}</span>
                            </span>
                            <span class="text-xs text-gray-400">{{ $reserva->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm">Nenhuma reserva ainda.</p>
            @endif
        </div>

        {{-- Últimas Avaliações --}}
        <div class="bg-white rounded-xl border border-borda-card p-5">
            <h2 class="font-bold text-texto-escuro border-b pb-2 mb-3">Últimas Avaliações</h2>
            @if($ultimasAvaliacoes->count())
                <ul class="space-y-3">
                    @foreach($ultimasAvaliacoes as $avaliacao)
                        <li class="text-sm flex justify-between items-center">
                            <span>
                                {{ Str::limit($avaliacao->comentario, 40) }} 
                                ({{ $avaliacao->nota }}/5)
                            </span>
                            <span class="text-xs text-gray-400">{{ $avaliacao->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm">Nenhuma avaliação ainda.</p>
            @endif
        </div>
    </div>

    {{-- FORMULÁRIO DE EDIÇÃO --}}
    <div class="bg-white rounded-xl border border-borda-card p-6">
        <h2 class="font-bold text-texto-escuro border-b pb-2 mb-4">Editar Perfil</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-texto-escuro font-medium mb-1">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           class="w-full px-3 py-2 border border-borda-card rounded-lg focus:ring-2 focus:ring-primaria">
                </div>
                <div>
                    <label class="block text-texto-escuro font-medium mb-1">Contato</label>
                    <input type="text" name="contato" value="{{ old('contato', $user->contato) }}" 
                           class="w-full px-3 py-2 border border-borda-card rounded-lg focus:ring-2 focus:ring-primaria">
                </div>
                <div>
                    <label class="block text-texto-escuro font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="w-full px-3 py-2 border border-borda-card rounded-lg focus:ring-2 focus:ring-primaria">
                </div>
                <div>
                    <label class="block text-texto-escuro font-medium mb-1">Nova Password (opcional)</label>
                    <input type="password" name="password" 
                           class="w-full px-3 py-2 border border-borda-card rounded-lg focus:ring-2 focus:ring-primaria">
                </div>
                <div>
                    <label class="block text-texto-escuro font-medium mb-1">Confirmar Password</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full px-3 py-2 border border-borda-card rounded-lg focus:ring-2 focus:ring-primaria">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">Cancelar</a>
                <button type="submit" class="px-5 py-2 bg-primaria text-white rounded-lg font-bold hover:bg-primaria-dark">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection