@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-xl border border-borda-card overflow-hidden">

        {{-- Cabeçalho --}}
        <div class="bg-primaria px-6 py-4">
            <h1 class="text-xl font-bold text-white">Reserva #{{ $reserva->id }}</h1>
        </div>

        {{-- Conteúdo --}}
        <div class="p-6 space-y-4">

            {{-- Cliente (utilizador associado) --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Cliente</strong> 
                    {{ $reserva->user->name ?? $reserva->nome_user ?? '—' }}
                </p>
            </div>

            {{-- Nome (campo denormalizado) --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Nome na reserva</strong> 
                    {{ $reserva->nome_user }}
                </p>
            </div>

            {{-- Contacto --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Contacto</strong> 
                    {{ $reserva->contato }}
                </p>
            </div>

            {{-- E-mail --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">E-mail</strong> 
                    {{ $reserva->email }}
                </p>
            </div>

            {{-- Hotel (relação directa, denormalizada) --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Hotel</strong> 
                    {{ $reserva->hotel->nome ?? '—' }}
                </p>
            </div>

            {{-- Check-in / Check-out --}}
            <div class="grid grid-cols-2 gap-4 border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Check-in</strong><br>
                    {{ \Carbon\Carbon::parse($reserva->checkin)->format('d/m/Y') }}
                </p>
                <p><strong class="text-texto-escuro">Check-out</strong><br>
                    {{ \Carbon\Carbon::parse($reserva->checkout)->format('d/m/Y') }}
                </p>
            </div>

            {{-- Status com cor --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Status</strong><br>
                    <span class="inline-flex items-center px-2 py-1 text-xs rounded-full font-semibold
                        @if($reserva->status == 'pendente') bg-yellow-100 text-yellow-700
                        @elseif($reserva->status == 'confirmada') bg-green-100 text-green-700
                        @elseif($reserva->status == 'cancelada') bg-red-100 text-red-700
                        @endif">
                        {{ ucfirst($reserva->status) }}
                    </span>
                </p>
            </div>

            {{-- Preço total --}}
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Preço total</strong><br>
                    <span class="text-primaria font-bold text-lg">
                        {{ number_format($reserva->preco_total, 2) }} Kz
                    </span>
                </p>
            </div>

            {{-- Lista de quartos (many‑to‑many) --}}
            <div>
                <h3 class="font-semibold text-texto-escuro mb-2">Quartos reservados</h3>
                @if($reserva->quartos->count())
                    <ul class="space-y-2">
                        @foreach($reserva->quartos as $quarto)
                            <li class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-medium">Quarto {{ $quarto->numero }}</span>
                                        <span class="text-sm text-gray-600">({{ $quarto->tipo }})</span>
                                        <div class="text-xs text-primaria mt-1">
                                            {{ $quarto->hotel->nome ?? 'Hotel' }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm">
                                            {{ $quarto->pivot->quantidade }} × {{ number_format($quarto->pivot->preco, 2) }} Kz/noite
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Subtotal: {{ number_format($quarto->pivot->preco * $quarto->pivot->quantidade, 2) }} Kz
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 text-sm">Nenhum quarto associado.</p>
                @endif
            </div>
        </div>

        {{-- Botão voltar --}}
        <div class="bg-gray-50 px-6 py-4 border-t border-borda-card">
            <a href="{{ route('reservas.index') }}" 
               class="bg-primaria text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-primaria-dark transition-all duration-200 inline-block">
                ← Voltar para listagem
            </a>
        </div>
    </div>
</div>
@endsection