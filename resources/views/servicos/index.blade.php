@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-black mb-6 text-texto-escuro border-b-4 border-primaria-light w-fit">
    Serviços por Hotel
</h1>

<a href="{{ route('servicos.create') }}"
   class="bg-primaria text-white px-5 py-2 rounded-lg mb-6 inline-block">
    Criar Serviços
</a>

<div class="bg-white rounded-xl border overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th>Hotel</th>
                <th>Serviços</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($hoteis as $hotel)
                <tr class="border-b">

                    <td class="text-center py-3 font-semibold">
                        {{ $hotel->nome }}
                    </td>

                    <td class="text-center py-3">
                        @foreach($hotel->servicos as $servico)
                            <span class="bg-gray-100 px-2 py-1 rounded text-xs">
                                {{ $servico->nome }}
                            </span>
                        @endforeach
                    </td>

                    <td class="text-center py-3 space-x-2">

                        <a href="{{ route('servicos.show', $hotel) }}"
                           class="text-primaria text-xs font-bold">
                            Ver
                        </a>

                        <a href="{{ route('servicos.edit', $hotel) }}"
                           class="text-primaria text-xs font-bold">
                            Editar
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection