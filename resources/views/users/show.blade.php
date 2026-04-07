@extends('layouts.app')

@section('content')

<h1>Detalhes do Usuário</h1>

<div class="bg-white mt-10 rounded-xl border border-borda-card overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-primaria text-white">
            <tr>
                <th>ID:</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Nome:</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Tipo de Usuário:</th>
                <td>{{ $user->role }}</td>
            </tr>
        </thead>
    </table>

</div>

{{-- Mensagem de sucesso --}}
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('users.edit', $user->id) }}">Editar</a>

<form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit">Excluir</button>
</form>

<br><br>

<a href="{{ route('users.index') }}">Voltar</a>

@endsection