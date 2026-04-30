@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Visão geral da plataforma')

@section('content')

{{-- KPI Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-lg shadow-sm border border-amber-100 p-4">
        <p class="text-xs text-stone-500 mb-1">Total de Hotéis</p>
        <p class="text-2xl font-bold text-amber-800">{{ $totalHoteis ?? 0 }}</p>
        <p class="text-[11px] text-amber-500 mt-1">registados na plataforma</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-amber-100 p-4">
        <p class="text-xs text-stone-500 mb-1">Reservas Activas</p>
        <p class="text-2xl font-bold text-amber-800">{{ $totalReservas ?? 0 }}</p>
        <p class="text-[11px] text-amber-500 mt-1">reservas em curso</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-amber-100 p-4">
        <p class="text-xs text-stone-500 mb-1">Pontos Turísticos</p>
        <p class="text-2xl font-bold text-amber-800">{{ $totalPontos ?? 0 }}</p>
        <p class="text-[11px] text-amber-500 mt-1">locais disponíveis</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-amber-100 p-4">
        <p class="text-xs text-stone-500 mb-1">Utilizadores</p>
        <p class="text-2xl font-bold text-amber-800">{{ $totalUtilizadores ?? 0 }}</p>
        <p class="text-[11px] text-amber-500 mt-1">registados</p>
    </div>

</div>

{{-- Segunda linha --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Reservas recentes --}}
    <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-amber-100 p-4">
        <h2 class="text-sm font-semibold text-amber-900 mb-3">Reservas Recentes</h2>
        <table class="w-full text-xs">
            <thead>
                <tr class="text-left text-stone-400 border-b border-stone-100">
                    <th class="pb-2 font-medium">Cliente</th>
                    <th class="pb-2 font-medium">Hotel</th>
                    <th class="pb-2 font-medium">Check-in</th>
                    <th class="pb-2 font-medium">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-50">
                @forelse($reservasRecentes ?? [] as $reserva)
                <tr class="py-2">
                    <td class="py-2 text-stone-700">{{ $reserva->user->name ?? '—' }}</td>
                    <td class="py-2 text-stone-700">{{ $reserva->hotel->nome ?? '—' }}</td>
                    <td class="py-2 text-stone-500">{{ \Carbon\Carbon::parse($reserva->checkin)->format('d/m/Y') }}</td>
                    <td class="py-2">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-medium
                            {{ $reserva->estado === 'confirmada' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ ucfirst($reserva->estado) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-stone-400">Nenhuma reserva recente</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('reservas.index') }}" class="mt-3 inline-block text-xs text-amber-600 hover:underline">
            Ver todas as reservas →
        </a>
    </div>

    {{-- Avaliações recentes --}}
    <div class="bg-white rounded-lg shadow-sm border border-amber-100 p-4">
        <h2 class="text-sm font-semibold text-amber-900 mb-3">Avaliações Recentes</h2>
        <div class="space-y-3">
            @forelse($avaliacoesRecentes ?? [] as $avaliacao)
            <div class="border-b border-stone-50 pb-2">
                <p class="text-xs text-stone-700 font-medium">{{ $avaliacao->user->name ?? 'Anónimo' }}</p>
                <p class="text-[11px] text-stone-400">{{ Str::limit($avaliacao->comentario, 60) }}</p>
                <div class="flex gap-0.5 mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $avaliacao->nota ? 'text-amber-400' : 'text-stone-200' }} text-xs">★</span>
                    @endfor
                </div>
            </div>
            @empty
            <p class="text-xs text-stone-400">Nenhuma avaliação ainda.</p>
            @endforelse
        </div>
        <a href="{{ route('avaliacoes.index') }}" class="mt-3 inline-block text-xs text-amber-600 hover:underline">
            Ver todas →
        </a>
    </div>

</div>

{{-- Terceira linha --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

    <a href="{{ route('servicos.index') }}" class="bg-white rounded-lg shadow-sm border border-amber-100 p-4 hover:border-amber-300 transition-colors">
        <p class="text-xs text-stone-500">Serviços</p>
        <p class="text-xl font-bold text-amber-800 mt-1">{{ $totalServicos ?? 0 }}</p>
    </a>

    <a href="{{ route('quartos.index') }}" class="bg-white rounded-lg shadow-sm border border-amber-100 p-4 hover:border-amber-300 transition-colors">
        <p class="text-xs text-stone-500">Quartos</p>
        <p class="text-xl font-bold text-amber-800 mt-1">{{ $totalQuartos ?? 0 }}</p>
    </a>

    <a href="{{ route('culturas.index') }}" class="bg-white rounded-lg shadow-sm border border-amber-100 p-4 hover:border-amber-300 transition-colors">
        <p class="text-xs text-stone-500">Culturas</p>
        <p class="text-xl font-bold text-amber-800 mt-1">{{ $totalCulturas ?? 0 }}</p>
    </a>

    <a href="{{ route('avaliacoes.index') }}" class="bg-white rounded-lg shadow-sm border border-amber-100 p-4 hover:border-amber-300 transition-colors">
        <p class="text-xs text-stone-500">Avaliações</p>
        <p class="text-xl font-bold text-amber-800 mt-1">{{ $totalAvaliacoes ?? 0 }}</p>
    </a>

</div>

@endsection