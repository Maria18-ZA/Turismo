@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="grid md:grid-cols-3 gap-8">
        
        {{-- COLUNA ESQUERDA: DETALHES DO QUARTO --}}
        <div class="md:col-span-2 space-y-6">
            {{-- Imagens do quarto (galeria simples) --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-md">
                @if($quarto->imagens->isNotEmpty())
                    <img src="{{ asset('storage/' . $quarto->imagens->first()->imagem) }}"
                         class="w-full h-80 object-cover" alt="{{ $quarto->nome }}">
                @else
                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-400 text-4xl">📷</div>
                @endif
                @if($quarto->imagens->count() > 1)
                    <div class="flex gap-2 p-2 overflow-x-auto">
                        @foreach($quarto->imagens as $img)
                            <img src="{{ asset('storage/' . $img->imagem) }}" class="h-16 w-16 object-cover rounded cursor-pointer hover:opacity-80" onclick="document.querySelector('.w-full.h-80').src = this.src">
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
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                <h3 class="text-2xl font-bold border-b pb-3 mb-4">Reservar este quarto</h3>

                <form action="{{ route('user.reservas.store') }}" method="POST" id="formReserva">
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
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label>Adultos</label>
                            <input type="number" name="adultos" id="adultos" value="2" min="1" class="w-full border rounded-xl px-4 py-3">
                        </div>
                        <div>
                            <label>Crianças</label>
                            <input type="number" name="criancas" id="criancas" value="0" min="0" class="w-full border rounded-xl px-4 py-3">
                        </div>
                    </div>

                    {{-- Extras --}}
                    <div class="bg-gray-50 p-4 rounded-xl mb-4">
                        <p class="font-semibold mb-2">Adicionais</p>
                        <label class="flex items-center gap-2 mb-2"><input type="checkbox" name="extras[]" value="cafe" data-preco="5000"> Café da manhã (+5.000 Kz/dia)</label>
                        <label class="flex items-center gap-2"><input type="checkbox" name="extras[]" value="cama_extra" data-preco="10000"> Cama extra (+10.000 Kz/noite)</label>
                    </div>

                    {{-- Total dinâmico --}}
                    <div class="border-t pt-4">
                        <div class="flex justify-between text-lg font-semibold">
                            <span>Total:</span>
                            <span id="totalReserva" class="text-xl text-blue-600">0 Kz</span>
                        </div>
                        <button type="submit" class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow-md">
                            Confirmar reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const precoNoite = {{ $quarto->preco }};
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const adultosInput = document.getElementById('adultos');
    const criancasInput = document.getElementById('criancas');
    const totalSpan = document.getElementById('totalReserva');

    function calcularTotal() {
        let checkin = new Date(checkinInput.value);
        let checkout = new Date(checkoutInput.value);
        if (isNaN(checkin) || isNaN(checkout) || checkout <= checkin) {
            totalSpan.textContent = '0 Kz';
            return;
        }
        let diffDias = (checkout - checkin) / (1000 * 60 * 60 * 24);
        let total = precoNoite * diffDias;

        // Extras
        document.querySelectorAll('input[name="extras[]"]:checked').forEach(cb => {
            let precoExtra = parseInt(cb.dataset.preco);
            if (cb.value === 'cafe') total += precoExtra * diffDias;
            if (cb.value === 'cama_extra') total += precoExtra * diffDias;
        });

        totalSpan.textContent = total.toLocaleString('pt-AO') + ' Kz';
    }

    checkinInput.addEventListener('change', calcularTotal);
    checkoutInput.addEventListener('change', calcularTotal);
    document.querySelectorAll('input[name="extras[]"]').forEach(cb => cb.addEventListener('change', calcularTotal));
    adultosInput.addEventListener('input', calcularTotal); // se quiser cobrar por hóspede extra, adapte
    criancasInput.addEventListener('input', calcularTotal);
</script>

@endsection