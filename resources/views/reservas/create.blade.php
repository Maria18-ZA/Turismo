@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <h1 class="text-2xl text-center font-bold mb-6">
        Nova Reserva
    </h1>

    {{-- ERROS --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULÁRIO --}}
    <form action="{{ route('reservas.store') }}"
          method="POST"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- NOME --}}
        <div>
            <label class="block mb-1 font-semibold">
                Nome
            </label>

            <input type="text"
                   name="nome_user"
                   required
                   value="{{ old('nome_user') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- CONTATO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Contato
            </label>

            <input type="text"
                   name="contato"
                   required
                   value="{{ old('contato') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block mb-1 font-semibold">
                E-mail
            </label>

            <input type="email"
                   name="email"
                   required
                   value="{{ old('email') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- CHECK-IN --}}
        <div>
            <label class="block mb-1 font-semibold">
                Check-in
            </label>

            <input type="date"
                   name="checkin"
                   required
                   value="{{ old('checkin') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- CHECK-OUT --}}
        <div>
            <label class="block mb-1 font-semibold">
                Check-out
            </label>

            <input type="date"
                   name="checkout"
                   required
                   value="{{ old('checkout') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- QUARTOS --}}
        <div>

            <h2 class="text-lg font-bold mb-3">
                Escolha os Quartos
            </h2>

            <div class="space-y-3">

                @foreach($quartos as $quarto)

                    <div class="border rounded-lg p-3 flex items-center gap-4">

                        <input type="checkbox"
                               name="quartos[{{ $quarto->id }}][ativo]"
                               value="1">

                        <div class="flex-1">
                            <p class="font-semibold">
                                Quarto {{ $quarto->numero }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $quarto->tipo }} —
                                {{ number_format($quarto->preco, 2) }} Kz/noite
                            </p>
                        </div>

                        <input type="number"
                               name="quartos[{{ $quarto->id }}][quantidade]"
                               min="1"
                               value="1"
                               class="w-20 border rounded-lg px-2 py-1">

                    </div>

                @endforeach

            </div>

        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('reservas.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Salvar
            </button>

        </div>

    </form>

</div>

@endsection