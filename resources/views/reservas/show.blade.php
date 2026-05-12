@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-xl border border-borda-card overflow-hidden">
        
        {{-- Cabeçalho --}}
        <div class="bg-primaria px-6 py-4">
            <h1 class="text-xl font-bold text-white">Reserva {{ $reserva->id }}</h1>
        </div>

        {{-- Conteúdo --}}
        <div class="p-6 space-y-4">
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Nome</strong> {{ $reserva->nome_user }}</p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Check-in</strong> {{ \Carbon\Carbon::parse($reserva->checkin)->format('d/m/Y') }}</p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Check-out</strong> {{ \Carbon\Carbon::parse($reserva->checkout)->format('d/m/Y') }}</p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Status</strong> 
                    <span class="
                        @if($reserva->status == 'pendente') text-yellow-600
                        @elseif($reserva->status == 'confirmada') text-green-600
                        @elseif($reserva->status == 'cancelada') text-red-600
                        @endif
                    ">
                        {{ ucfirst($reserva->status) }}
                    </span>
                </p>
            </div>
            
            <div class="border-b border-borda-card pb-3">
                <p><strong class="text-texto-escuro">Preço total:</strong> 
                    <span class="text-primaria font-bold">{{ number_format($reserva->preco_total, 2) }} Kz</span>
                </p>
            </div>
            
            <div>
                <h3 class="font-semibold text-texto-escuro mb-2">Quartos:</h3>
                <ul class="list-disc list-inside space-y-1 text-gray-700">
                    @foreach($reserva->quartos as $q)
                        <li>{{ $q->numero }} - {{ $q->tipo }} (x{{ $q->pivot->quantidade }}, {{ number_format($q->pivot->preco, 2) }}Kz/noite)</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Botão voltar --}}
        <div class="bg-gray-50 px-6 py-4 border-t border-borda-card">
            <a href="{{ route('reservas.index') }}" 
               class="bg-primaria text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-primaria-dark transition-all duration-200">
                ← Voltar
            </a>
        </div>
    </div>
</div>
@endsection