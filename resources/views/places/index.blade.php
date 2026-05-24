@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-8">

    <h1 class="text-3xl font-black text-gray-900 border-b-4 border-gray-200 pb-2 w-fit">
        Lista de Lugares
    </h1>

    <a href="{{ route('places.create') }}"
       class="bg-gray-900 text-white text-sm font-bold px-5 py-2.5 rounded-lg hover:bg-gray-800 transition">
        Novo Lugar
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
                <th class="px-5 py-3 text-left">Título</th>
                <th class="px-5 py-3 text-left">Descrição</th>
                <th class="px-5 py-3 text-left">Categoria</th>
                <th class="px-5 py-3 text-left">Imagem</th>
                <th class="px-5 py-3 text-left">Link</th>
                <th class="px-5 py-3 text-left">Ações</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">

            @forelse($places as $place)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-5 py-3 text-gray-700">
                        {{ $place->id }}
                    </td>

                    <td class="px-5 py-3 font-medium text-gray-900">
                        {{ $place->titulo }}
                    </td>

                    <td class="px-5 py-3 text-gray-600">
                        {{ Str::limit($place->descricao, 50) }}
                    </td>

                    <td class="px-5 py-3 text-gray-600">
                        {{ $place->categoria }}
                    </td>

                    <td class="px-5 py-3">
                        <img src="{{ $place->imagem }}"
                             class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                    </td>

                    <td class="px-5 py-3 text-gray-600">
                        @if($place->link)
                            <a href="{{ $place->link }}" target="_blank" class="text-blue-600 hover:underline">
                                Abrir
                            </a>
                        @else
                            —
                        @endif
                    </td>

                    <td class="px-5 py-3">

                        <div class="flex gap-3 text-xs font-semibold">

                            <a href="{{ route('places.edit', $place->id) }}"
                               class="text-gray-700 hover:text-black">
                                Editar
                            </a>

                            <form action="{{ route('places.destroy', $place->id) }}"
                                  method="POST">
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
                        Nenhum lugar encontrado.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection