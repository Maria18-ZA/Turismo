@extends('layouts.app')

@section('content')

<h1>Editar Usuário</h1>

{{-- Mostrar erros --}}
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST">
@csrf
@method('PUT')

Nome: 
<input type="text" name="name" value="{{ old('name', $user->name) }}"><br>

Email: 
<input type="email" name="email" value="{{ old('email', $user->email) }}"><br>

Função:
<select name="role">
    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="turista" {{ old('role', $user->role) == 'turista' ? 'selected' : '' }}>Turista</option>
    <option value="gestor" {{ old('role', $user->role) == 'gestor' ? 'selected' : '' }}>Gestor</option>
</select><br>

Nova Senha:
<input type="password" name="password"><br>

Confirmar Senha:
<input type="password" name="password_confirmation"><br>

<button type="submit">Atualizar</button>
</form>

<a href="{{ route('users.index') }}">Voltar</a>

@endsection