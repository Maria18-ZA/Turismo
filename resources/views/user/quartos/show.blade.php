@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="grid md:grid-cols-3 gap-8">
        
        {{-- COLUNA ESQUERDA: DETALHES DO QUARTO --}}
        <div class="md:col-span-2 space-y-6">
            {{-- Galeria de imagens do quarto --}}
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

        {{-- COLUNA DIREITA: FORMULÁRIO DE RESERVA (STICKY) --}}
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-24 transition-all z-20">
                <h3 class="text-2xl font-bold border-b pb-3 mb-4">Reservar</h3>

                <form action="{{ route('reservas.store') }}" method="POST" id="formReserva">
                    @csrf
                    <input type="hidden" name="quarto_id" value="{{ $quarto->id }}">

                    {{-- Datas --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Check-in</label>
                        <input type="date" name="checkin" id="checkin" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Check-out</label>
                        <input type="date" name="checkout" id="checkout" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    {{-- Hóspedes --}}
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block font-medium mb-1">Adultos</label>
                            <input type="number" name="adultos" id="adultos" value="2" min="1" class="w-full border rounded-xl px-4 py-3">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Crianças</label>
                            <input type="number" name="criancas" id="criancas" value="0" min="0" class="w-full border rounded-xl px-4 py-3">
                        </div>
                    </div>

                    {{-- Total dinâmico --}}
                    <div class="bg-gray-50 rounded-xl p-4 mb-4">
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

{{-- No mobile, o formulário vira uma barra inferior fixa (igual Booking) --}}
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
    const adultosInput = document.getElementById('adultos');
    const criancasInput = document.getElementById('criancas');
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
        let total = precoNoite * diffDias;

        // Se quiser cobrar por hóspede extra (opcional):
        // let adultos = parseInt(adultosInput.value) || 1;
        // let criancas = parseInt(criancasInput.value) || 0;
        // total = total + (adultos - 2) * 5000 * diffDias; // exemplo

        totalSpan.textContent = total.toLocaleString('pt-AO') + ' Kz';
        if (totalMobileSpan) totalMobileSpan.textContent = total.toLocaleString('pt-AO') + ' Kz';
    }

    checkinInput.addEventListener('change', calcularTotal);
    checkoutInput.addEventListener('change', calcularTotal);
    adultosInput.addEventListener('input', calcularTotal);
    criancasInput.addEventListener('input', calcularTotal);
    calcularTotal(); // inicializa
</script>

@endsection