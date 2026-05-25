@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">

        <div>
            <h1 class="text-3xl font-black text-texto-escuro border-b-4 border-primaria-light w-fit pb-2">
                Avaliações
            </h1>
            <p class="text-sm text-texto-medio mt-2">
                Lista de todas as avaliações feitas na plataforma
            </p>
        </div>

        @auth
            <a href="{{ route('avaliacoes.create') }}"
               class="bg-primaria text-white text-sm font-bold px-5 py-2.5 rounded-xl
                      hover:bg-primaria-dark transition hover:-translate-y-0.5">
                Nova Avaliação
            </a>
        @endauth
    </div>

    {{-- ALERTA --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="bg-white border border-borda-card rounded-2xl overflow-hidden shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- HEADER --}}
                <thead class="bg-primaria text-white">
                    <tr>
                        <th class="px-5 py-3 text-left">ID</th>
                        <th class="px-5 py-3 text-left">Avaliador</th>
                        <th class="px-5 py-3 text-left">Hotel</th>
                        <th class="px-5 py-3 text-left">Ponto Turístico</th>
                        <th class="px-5 py-3 text-left">Nota</th>
                        <th class="px-5 py-3 text-left">Comentário</th>
                        <th class="px-5 py-3 text-left">Ações</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-borda-card">

                    @forelse($avaliacoes as $avaliacao)

                        <tr class="hover:bg-fundo-secao transition">

                            <td class="px-5 py-3 font-medium text-texto-escuro">
                                {{ $avaliacao->id }}
                            </td>

                            {{-- AVALIADOR --}}
                            <td class="px-5 py-3 text-texto-escuro font-medium">
                                {{ $avaliacao->email ? explode('@', $avaliacao->email)[0] : 'Anónimo' }}
                                <div class="text-xs text-texto-medio font-normal">
                                    {{ $avaliacao->email }}
                                </div>
                            </td>

                            {{-- HOTEL --}}
                            <td class="px-5 py-3 text-texto-escuro">
                                {{ $avaliacao->hotel->nome ?? '-' }}
                            </td>

                            {{-- PONTO --}}
                            <td class="px-5 py-3 text-texto-escuro">
                                {{ $avaliacao->pontoTuristico->nome ?? '-' }}
                            </td>

                            {{-- NOTA --}}
                            <td class="px-5 py-3">
                                <span class="font-bold text-primaria">
                                    {{ $avaliacao->nota }} ⭐
                                </span>
                            </td>

                            {{-- COMENTÁRIO --}}
                            <td class="px-5 py-3 text-texto-medio">
                                {{ \Illuminate\Support\Str::limit($avaliacao->comentario, 60) }}
                            </td>

                            {{-- AÇÕES --}}
                            <td class="px-5 py-3">

                                <div class="flex items-center gap-3">

                                    <a href="{{ route('avaliacoes.show', $avaliacao) }}"
                                       class="text-primaria text-xs font-bold hover:text-primaria-dark">
                                        Ver
                                    </a>

                                    @auth
                                        @php
                                            $user = auth()->user();
                                            $isAuthor = $user->id === $avaliacao->user_id;
                                            $isAdminOrGestor = in_array($user->role, ['admin', 'gestor']);
                                        @endphp

                                        @if($isAuthor || $isAdminOrGestor)

                                            <a href="{{ route('avaliacoes.edit', $avaliacao) }}"
                                               class="text-primaria text-xs font-bold hover:text-primaria-dark">
                                                Editar
                                            </a>

                                            <form action="{{ route('avaliacoes.destroy', $avaliacao) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Deseja realmente excluir?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-red-600 text-xs font-bold hover:text-red-800">
                                                    Excluir
                                                </button>
                                            </form>

                                        @endif
                                    @endauth

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-texto-medio">
                                Nenhuma avaliação encontrada.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection