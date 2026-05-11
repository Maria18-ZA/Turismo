@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Avaliações</h1>

    @auth
    <a href="{{ route('avaliacoes.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold rounded-lg px-5 py-2.5 mb-7 hover:bg-primaria-dark hover:-translate-y-0.5 transition-all duration-200">
        Nova Avaliação
    </a>
    @endauth

    @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white mt-10 rounded-xl border border-borda-card overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-primaria text-white">
                <tr>
                    <th class="text-center px-5 py-3 font-semibold">ID</th>
                    <th class="text-center px-5 py-3 font-semibold">Usuário</th> {{-- NOVA COLUNA --}}
                    <th class="text-center px-5 py-3 font-semibold">Hotel</th>
                    <th class="text-center px-5 py-3 font-semibold">Ponto Turístico</th>
                    <th class="text-center px-5 py-3 font-semibold">Nota</th>
                    <th class="text-center px-5 py-3 font-semibold">Comentário</th>
                    <th class="text-center px-5 py-3 font-semibold">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-borda-card">
                @foreach($avaliacoes as $avaliacao)
                <tr>
                    <td class="text-center px-5 py-3">{{ $avaliacao->id }}</td>
                    <td class="text-center px-5 py-3 font-medium text-texto-escuro">
                        {{ $avaliacao->user->name ?? 'Desconhecido' }}
                    </td>
                    <td class="text-center px-5 py-3">{{ $avaliacao->hotel ? $avaliacao->hotel->nome : '-' }}</td>
                    <td class="text-center px-5 py-3">{{ $avaliacao->pontoTuristico ? $avaliacao->pontoTuristico->nome : '-' }}</td>
                    <td class="text-center px-5 py-3">{{ $avaliacao->nota ?? $avaliacao->nota }} ⭐</td> {{-- ajuste para nota --}}
                    <td class="text-center px-5 py-3">{{ Str::limit($avaliacao->comentario, 50) }}</td>
                    <td class="text-center px-5 py-3">
                        <a href="{{ route('avaliacoes.show', $avaliacao) }}" class="text-primaria text-xs font-bold hover:text-primaria-dark">Ver</a>

                        @auth
                            @php
                                $user = auth()->user();
                                $isAuthor = $user->id === $avaliacao->user_id;
                                $isAdminOrGestor = in_array($user->role, ['admin', 'gestor']);
                            @endphp

                            @if($isAuthor || $isAdminOrGestor)
                                <a href="{{ route('avaliacoes.edit', $avaliacao) }}" class="text-primaria text-xs font-bold hover:text-primaria-dark ml-2">Editar</a>
                                <form action="{{ route('avaliacoes.destroy', $avaliacao) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-xs font-bold hover:text-red-800 ml-2">Excluir</button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection