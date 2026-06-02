@extends('layouts.user')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="grid md:grid-cols-3 gap-8">
        
        {{-- COLUNA ESQUERDA: DETALHES DO QUARTO --}}
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl overflow-hidden shadow-md">
                @if($quarto->imagens->isNotEmpty())
                    <img id="quartoImagemPrincipal" src="{{ asset('storage/' . $quarto->imagens->first()->imagem) }}"
                         class="w-full h-80 object-cover" alt="{{ $quarto->nome }}">
                @else
                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-400 text-4xl">📷</div>
                @endif
                @if($quarto->imagens->count() > 1)
                    <div class="flex gap-2 p-2 overflow-x-auto">
                        @foreach($quarto->imagens as $img)
                            <img src="{{ asset('storage/' . $img->imagem) }}" 
                                 class="h-16 w-16 object-cover rounded cursor-pointer hover:opacity-80" 
                                 onclick="document.getElementById('quartoImagemPrincipal').src = this.src">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h1 class="text-3xl font-bold text-gray-800">{{ $quarto->nome }}</h1>
                <p class="text-gray-600 mt-2 leading-relaxed">{{ $quarto->descricao }}</p>
                <hr class="my-4">
                <h3 class="text-xl font-semibold mb-3">Comodidades</h3>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Wi-Fi grátis</span>
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Ar condicionado</span>
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Frigobar</span>
                    <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Cofre</span>
                </div>
                <hr class="my-4">
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-blue-600">{{ number_format($quarto->preco, 0, ',', '.') }} Kz</span>
                    <span class="text-gray-500">/ noite</span>
                </div>
            </div>
        </div>

        {{-- COLUNA DIREITA: FORMULÁRIO DE RESERVA --}}
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-24 transition-all z-20">
                <h3 class="text-2xl font-bold border-b pb-3 mb-4">Reservar</h3>

                <form action="{{ route('reservas.store') }}" method="POST" id="formReserva">
                    @csrf

                    {{-- Dados pessoais --}}
                    <div class="mb-3">
                        <label class="block font-medium mb-1">Nome completo *</label>
                        <input type="text" name="nome_user" value="{{ old('nome_user') }}" required
                               class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                        @error('nome_user') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium mb-1">Contacto *</label>
                        <input type="text" name="contato" value="{{ old('contato') }}" required
                               class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                        @error('contato') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium mb-1">E-mail *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Datas --}}
                    <div class="mb-3">
                        <label class="block font-medium mb-1">Check-in</label>
                        <input type="date" name="checkin" id="checkin" value="{{ old('checkin') }}" required
                               class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                        @error('checkin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium mb-1">Check-out</label>
                        <input type="date" name="checkout" id="checkout" value="{{ old('checkout') }}" required
                               class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                        @error('checkout') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- QUANTIDADE DE QUARTOS (campo visível) --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Número de quartos</label>
                        <input type="number" name="quartos[{{ $quarto->id }}][quantidade]" id="quantidade_quartos" 
                               value="{{ old('quartos.' . $quarto->id . '.quantidade', 1) }}" min="1" max="10"
                               class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                        @error('quartos.' . $quarto->id . '.quantidade') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Total dinâmico --}}
                    <div class="bg-gray-50 rounded-xl p-4 my-4">
                        <div class="flex justify-between text-lg font-semibold">
                            <span>Total:</span>
                            <span id="totalReserva" class="text-xl text-blue-600">0 Kz</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow-md">
                        Confirmar reserva
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Barra inferior fixa para mobile --}}
<div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg p-4 flex gap-3 md:hidden z-30">
    <div class="flex-1">
        <div class="text-sm text-gray-600">Total</div>
        <div class="text-xl font-bold text-blue-600" id="totalMobile">0 Kz</div>
    </div>
    <button type="submit" form="formReserva" class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold">
        Reservar
    </button>
</div>

<script>
    const precoNoite = {{ $quarto->preco }};
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const quantidadeInput = document.getElementById('quantidade_quartos');
    const totalSpan = document.getElementById('totalReserva');
    const totalMobileSpan = document.getElementById('totalMobile');

    function calcularTotal() {
        let checkin = new Date(checkinInput.value);
        let checkout = new Date(checkoutInput.value);
        if (isNaN(checkin) || isNaN(checkout) || checkout <= checkin) {
            totalSpan.textContent = '0 Kz';
            if (totalMobileSpan) totalMobileSpan.textContent = '0 Kz';
            return;
        }
        let diffDias = (checkout - checkin) / (1000 * 60 * 60 * 24);
        let quantidade = parseInt(quantidadeInput.value) || 1;
        let total = precoNoite * diffDias * quantidade;
        totalSpan.textContent = total.toLocaleString('pt-AO') + ' Kz';
        if (totalMobileSpan) totalMobileSpan.textContent = total.toLocaleString('pt-AO') + ' Kz';
    }

    checkinInput.addEventListener('change', calcularTotal);
    checkoutInput.addEventListener('change', calcularTotal);
    quantidadeInput.addEventListener('input', calcularTotal);
    calcularTotal();
</script>
@endsection