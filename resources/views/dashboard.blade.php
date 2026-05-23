@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Visão geral do Visita Já')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria w-fit pb-2">
            Dashboard
        </h1>
        <p class="text-sm text-gray-600 mt-1">
            Visão geral do Visita Já
        </p>
    </div>

    {{-- KPI CARDS (MAIS CONTRASTE) --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        @php
            $cards = [
                ['label' => 'Hotéis', 'value' => $totalHoteis ?? 0],
                ['label' => 'Reservas', 'value' => $totalReservas ?? 0],
                ['label' => 'Pontos Turísticos', 'value' => $totalPontos ?? 0],
                ['label' => 'Utilizadores', 'value' => $totalUtilizadores ?? 0],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-primaria-dark text-white rounded-xl p-4 shadow-md hover:scale-[1.02] transition">

            <p class="text-xs text-primaria-light">
                {{ $card['label'] }}
            </p>

            <p class="text-3xl font-black mt-2">
                {{ $card['value'] }}
            </p>

            <div class="mt-2 h-1 w-10 bg-primaria rounded-full"></div>
        </div>
        @endforeach

    </div>

    {{-- SEGUNDA LINHA --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- RESERVAS --}}
        <div class="lg:col-span-2 bg-white border border-borda-card rounded-xl p-4 shadow-sm">

            <h2 class="text-sm font-bold text-texto-escuro mb-4 border-b pb-2">
                Reservas Recentes
            </h2>

            <table class="w-full text-sm">

                <thead class="text-xs text-gray-500">
                    <tr>
                        <th class="text-left py-2">Cliente</th>
                        <th class="text-left py-2">Hotel</th>
                        <th class="text-left py-2">Check-in</th>
                        <th class="text-left py-2">Estado</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($reservasRecentes ?? [] as $reserva)

                    <tr class="hover:bg-fundo-secao transition">
                        <td class="py-2 font-medium text-texto-escuro">
                            {{ $reserva->user->name ?? '—' }}
                        </td>

                        <td class="py-2 text-gray-600">
                            {{ $reserva->quartos->first()->hotel->nome ?? '—' }}
                        </td>

                        <td class="py-2 text-gray-500">
                            {{ \Carbon\Carbon::parse($reserva->checkin)->format('d/m/Y') }}
                        </td>

                        <td class="py-2">
                            <span class="px-2 py-1 text-xs rounded-full font-semibold
                                {{ $reserva->estado === 'confirmada'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($reserva->estado) }}
                            </span>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-400">
                            Nenhuma reserva recente
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- AVALIAÇÕES --}}
        <div class="bg-primaria-dark text-white rounded-xl p-4 shadow-md">

            <h2 class="text-sm font-bold border-b border-primaria-light pb-2 mb-4">
                Avaliações Recentes
            </h2>

            <div class="space-y-3">

                @forelse($avaliacoesRecentes ?? [] as $avaliacao)

                @php
                    $email = $avaliacao->email ?? null;
                    $avaliador = $email ? explode('@', $email)[0] : 'Anónimo';
                @endphp

                <div class="border-b border-primaria-light pb-2">

                    <p class="text-sm font-semibold">
                        {{ $avaliador }}
                    </p>

                    <p class="text-xs text-primaria-light">
                        {{ Str::limit($avaliacao->comentario, 60) }}
                    </p>

                    <div class="text-yellow-300 text-xs mt-1">
                        @for($i = 1; $i <= $avaliacao->nota; $i++)
                            ★
                        @endfor
                    </div>

                </div>

                @empty
                <p class="text-xs text-primaria-light">
                    Sem avaliações ainda
                </p>
                @endforelse

            </div>
        </div>

    </div>

    {{-- LINKS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        @php
            $links = [
                ['label' => 'Serviços', 'value' => $totalServicos ?? 0],
                ['label' => 'Quartos', 'value' => $totalQuartos ?? 0],
                ['label' => 'Culturas', 'value' => $totalCulturas ?? 0],
                ['label' => 'Avaliações', 'value' => $totalAvaliacoes ?? 0],
            ];
        @endphp

        @foreach($links as $link)
        <a href="#"
           class="bg-white border border-borda-card rounded-xl p-4 shadow-sm hover:border-primaria hover:-translate-y-1 transition">

            <p class="text-xs text-gray-500">{{ $link['label'] }}</p>

            <p class="text-2xl font-bold text-primaria mt-1">
                {{ $link['value'] }}
            </p>

        </a>
        @endforeach

    </div>

</div>

@endsection