@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">

    <h1 class="text-2xl text-center font-bold mb-6">
        Novo Serviço
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

    <form action="{{ route('servicos.store') }}"
          method="POST"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- HOTEL --}}
        <div>
            <label class="block mb-1 font-semibold">Hotel</label>

            <select name="hotel_id"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="">Seleciona um hotel</option>

                @foreach($hoteis as $hotel)

                    <option value="{{ $hotel->id }}"
                        {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>

                        {{ $hotel->nome }}

                    </option>

                @endforeach

            </select>
        </div>

        {{-- SERVIÇOS --}}
        <div>
            <label class="block mb-2 font-semibold">
                Serviços Disponíveis
            </label>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                @foreach($servicosExistentes ?? [] as $servico)

                    @php
                        $checked = is_array(old('servicos')) 
                                   && in_array($servico, old('servicos'));
                    @endphp

                    <label class="flex items-center gap-2 border rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-50">

                        <input type="checkbox"
                               name="servicos[]"
                               value="{{ $servico }}"
                               {{ $checked ? 'checked' : '' }}>

                        <span class="text-sm">
                            {{ $servico }}
                        </span>

                    </label>

                @endforeach

            </div>
        </div>

        {{-- NOVOS SERVIÇOS --}}
        <div>
            <label class="block mb-1 font-semibold">
                Adicionar novos serviços
            </label>

            <input type="text"
                   name="novo_servico"
                   value="{{ old('novo_servico') }}"
                   placeholder="Ex: Jacuzzi, Sauna, Lavandaria"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('servicos.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Criar
            </button>

        </div>

    </form>

</div>

@endsection