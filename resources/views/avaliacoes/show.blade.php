@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl mt-10">
    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-2xl font-bold mb-6">Detalhes da Avaliação</h1>

        <div class="space-y-4">

            {{-- AVALIADOR --}}
            <div class="border-b pb-3">
                <strong class="text-gray-700">Avaliador:</strong>

                <span class="ml-2 font-semibold text-blue-700">
                    {{ $avaliacao->email ? explode('@', $avaliacao->email)[0] : 'Anónimo' }}
                </span>

                <span class="text-sm text-gray-500">
                    ({{ $avaliacao->email ?? 'sem email' }})
                </span>
            </div>

            {{-- HOTEL --}}
            <div>
                <strong>Hotel:</strong>
                <span>{{ $avaliacao->hotel?->nome ?? '-' }}</span>
            </div>

            {{-- PONTO TURÍSTICO --}}
            <div>
                <strong>Ponto Turístico:</strong>
                <span>{{ $avaliacao->pontoTuristico?->nome ?? '-' }}</span>
            </div>

            {{-- NOTA --}}
            <div>
                <strong>Nota:</strong>
                <span class="text-yellow-500">
                    {{ str_repeat('⭐', $avaliacao->nota) }}
                </span>
                <span class="ml-1">({{ $avaliacao->nota }}/5)</span>
            </div>

            {{-- COMENTÁRIO --}}
            <div>
                <strong>Comentário:</strong>
                <p class="mt-1 text-gray-700">
                    {{ $avaliacao->comentario ?: 'Sem comentário' }}
                </p>
            </div>

        </div>

        {{-- AÇÕES --}}
        @auth
            @php
                $user = auth()->user();
                $isAdminOrGestor = in_array($user->role, ['admin', 'gestor']);
            @endphp

            @if($isAdminOrGestor)
                <div class="mt-8 flex gap-3">
                    <a href="{{ route('avaliacoes.edit', $avaliacao) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        Editar
                    </a>

                    <form action="{{ route('avaliacoes.destroy', $avaliacao) }}"
                          method="POST"
                          onsubmit="return confirm('Tem certeza?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Excluir
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        <div class="mt-6 text-center">
            <a href="{{ route('avaliacoes.index') }}" class="text-blue-600 hover:underline">
                Voltar
            </a>
        </div>

    </div>
</div>
@endsection