@extends('layouts.app')

@section('content')


    <h1 class="text-texto-escuro text-3xl font-black mb-7 pb-2 border-b-4 border-primaria-light w-fit">Avaliações</h1>

    <a href="{{ route('avaliacoes.create') }}" class="bg-primaria mt-10 text-white text-sm font-bold
               rounded-lg px-5 py-2.5 mb-7
              hover:bg-primaria-dark hover:-translate-y-0.5
              transition-all duration-200">Nova Avaliação</a>

    <div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th class="text-center px-5 py-3 font-semibold">ID</th>
                <th class="text-center px-5 py-3 font-semibold">Hotel</th>
                <th class="text-center px-5 py-3 font-semibold">Ponto Turístico</th>
                <th class="text-center px-5 py-3 font-semibold">Nota</th>
                <th class="text-center px-5 py-3 font-semibold">Comentário</th>
                <th class="text-center px-5 py-3 font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-borda-card"
            @foreach($avaliacoes as $avaliacao)
            <tr>
                <td>{{ $avaliacao->id }}</td>
            
                <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $avaliacao->hotel ? $avaliacao->hotel->nome : '-' }}</td>
                <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $avaliacao->pontoTuristico ? $avaliacao->pontoTuristico->nome : '-' }}</td>
                <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $avaliacao->nota }}</td>
                <td class="text-center px-5 py-3 font-medium text-texto-escuro">{{ $avaliacao->comentario }}</td>
                <td class="text-center px-5 py-3">

                    <a href="{{ route('avaliacoes.show', $avaliacao) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Ver</a>
                    <a href="{{ route('avaliacoes.edit', $avaliacao) }}" class="text-primaria  text-xs  font-bold hover:text-primaria-dark transition-colors">Editar</a>
                    <form action="{{ route('avaliacoes.destroy', $avaliacao) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-primaria text-xs  font-bold hover:text-primaria-dark transition-colors onclick="return confirm('Deseja realmente excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection