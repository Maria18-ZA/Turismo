@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10 text-texto-escuro">

    {{-- TÍTULO --}}
    <h1 class="text-2xl text-center font-bold mb-6">
        Novo Usuário
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

    {{-- FORMULÁRIO --}}
    <form action="{{ route('users.store') }}"
          method="POST"
          class="bg-white p-6 rounded-lg shadow border space-y-4">

        @csrf

        {{-- NOME --}}
        <div>
            <label class="block mb-1 font-semibold">
                Nome
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block mb-1 font-semibold">
                Email
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

         <div>
            <label class="block mb-1 font-semibold">
                Contato
            </label>

            <input type="contato"
                   name="contato"
                   value="{{ old('contato') }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- FUNÇÃO --}}
        <div>
            <label class="block mb-1 font-semibold">
                Função
            </label>

            <select name="role"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="admin"
                    {{ old('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="gestor"
                    {{ old('role') == 'gestor' ? 'selected' : '' }}>
                    Gestor
                </option>

            </select>
        </div>

        {{-- SENHA --}}
        <div>
            <label class="block mb-1 font-semibold">
                Senha
            </label>

            <input type="password"
                   name="password"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- SENHA --}}
        <div>
            <label class="block mb-1 font-semibold">
                Confirmar Senha
            </label>

            <input type="password" name="password_confirmation"
                   class="w-full border rounded-lg px-4 py-2">
        </div>


        {{-- BOTÕES --}}
        <div class="flex justify-between pt-4">

            <a href="{{ route('users.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                Voltar
            </a>

            <button type="submit"
                    class="bg-primaria text-white px-5 py-2 rounded-lg">
                Salvar
            </button>

        </div>

    </form>

</div>

@endsection