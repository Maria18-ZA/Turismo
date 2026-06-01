@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-black text-gray-900 border-b-4 border-gray-200 pb-2 w-fit">
        Lista de Hotéis
    </h1>

    <a href="{{ route('hoteis.create') }}"
       class="bg-gray-900 text-white text-sm font-bold px-5 py-2.5 rounded-lg hover:bg-gray-800 transition">
        Criar Hotel
    </a>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
            <tr>
                <th class="px-5 py-3 text-left">ID</th>
                <th class="px-5 py-3 text-left">Nome</th>
                <th class="px-5 py-3 text-left">Localização</th>
                <th class="px-5 py-3 text-left">Categoria</th>
                <th class="px-5 py-3 text-left">Contacto</th>
                <th class="px-5 py-3 text-left">Imagem</th>
                <th class="px-5 py-3 text-left">Ações</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">

            @forelse($hoteis as $hotel)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-5 py-3 text-gray-700">{{ $hotel->id }}</td>

                    <td class="px-5 py-3 font-medium text-gray-900">
                        {{ $hotel->nome }}
                    </td>

                    <td class="px-5 py-3 text-gray-600">
                        {{ $hotel->localizacao }}
                    </td>

                    <td class="px-5 py-3 text-gray-600">
                        {{ $hotel->categoria ?? '—' }}
                    </td>

                    <td class="px-5 py-3 text-gray-600">
                        {{ $hotel->contato ?? '—' }}
                    </td>
                    
                    @php
                        $imagemPrincipal = $hotel->imagens->where('is_principal', 1)->first();
                    @endphp

                    <td class="px-5 py-3">
                       <td class="px-5 py-3">
                            @if($imagemPrincipal)
                                <img src="{{ Storage::url($imagemPrincipal->imagem) }}"
                                    class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                            @else
                                <span class="text-gray-400 text-xs">Sem imagem</span>
                            @endif
                        </td>
                    </td>

                    <td class="px-5 py-3">

                        <div class="flex gap-3 text-xs font-semibold">
                            <a href="{{ route('hoteis.show', $hotel) }}"
                               class="text-gray-700 hover:text-black">
                                Ver
                            </a>

                            <a href="{{ route('hoteis.edit', $hotel) }}"
                               class="text-gray-700 hover:text-black">
                                Editar
                            </a>

                            <form action="{{ route('hoteis.destroy', $hotel) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Tens a certeza?')"
                                        class="text-red-500 hover:text-red-700">
                                    Eliminar
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-gray-400">
                        Nenhum hotel encontrado.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection