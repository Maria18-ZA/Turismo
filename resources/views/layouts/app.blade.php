<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Visita Já') }} — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-fundo-secao text-white font-sans">

<div class="flex h-screen">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-64 bg-black text-white border-borda-card flex flex-col">

        {{-- BRAND/ Coluna lateral esquerda --}}
        <div class="px-2 py-5 border-b border-borda-card">
            <div class="text-white font-bold text-lg tracking-wide">
                {{ config('app.name', 'Visita Já') }}
            </div>
            <div class="text-fundo-secao text-xs mt-1">
                @if(auth()->check())
                    @switch(auth()->user()->role)
                        @case('admin')
                            Área do Administrador
                            @break
                        @case('gestor')
                            Área do Gestor
                            @break
                        @default
                            Área do Utilizador
                    @endswitch
                @endif
            </div>
        </div>

        {{-- NAV --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

            @php
                function active($route) {
                    return request()->routeIs($route)
                        ? 'bg-primaria text-white'
                        : 'text-fundo-secao hover:bg-primaria hover:text-white';
                }
                $role = auth()->check() ? auth()->user()->role : 'guest';
            @endphp

            {{-- Dashboard – todos os autenticados --}}
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-lg text-sm {{ active('dashboard') }}">
                Dashboard
            </a>

            @if($role === 'admin')
                <div class="text-[10px] uppercase tracking-widest text-primaria-light px-3 mt-4 mb-2">
                    Gestão Global
                </div>

                <a href="{{ route('places.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('places.*') }}">
                    Places
                </a>

                <a href="{{ route('pontosturisticos.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('pontosturisticos.*') }}">
                    Pontos Turísticos
                </a>

                <a href="{{ route('culturas.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('culturas.*') }}">
                    Culturas
                </a>

              
            @endif

            {{-- Secção comum para Admin e Gestor (hotel, quartos, reservas, serviços, avaliações) --}}
            @if(in_array($role, ['admin', 'gestor']))
                <div class="text-[10px] uppercase tracking-widest text-primaria-light px-3 mt-4 mb-2">
                    Gestão Hoteleira
                </div>

                <a href="{{ route('hoteis.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('hoteis.*') }}">
                    Hotéis
                </a>

                <a href="{{ route('quartos.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('quartos.*') }}">
                    Quartos
                </a>

                <a href="{{ route('reservas.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('reservas.*') }}">
                    Reservas
                </a>

                <a href="{{ route('servicos.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('servicos.*') }}">
                    Serviços
                </a>

                <a href="{{ route('avaliacoes.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('avaliacoes.*') }}">
                    Avaliações
                </a>

                 <a href="{{ route('users.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm {{ active('users.*') }}">
                    Usuários
                </a>


                 <a href="{{ route('profile') }}" class="block px-3 py-2 rounded-lg text-sm text-fundo-secao hover:bg-primaria hover:text-white">
    Meu Perfil
</a>
            @endif

        </nav>

        {{-- USER PANEL --}}
        <div class="border-t border-borda-card p-4">
            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-primaria flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                    </div>

                    <div>
                        <div class="text-white text-sm font-semibold">
                            {{ auth()->user()->name ?? 'User' }}
                        </div>
                        <div class="text-xs text-primaria-light capitalize">
                            {{ auth()->user()->role ?? '' }}
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-xs text-red-400 hover:text-red-300">
                        Sair
                    </button>
                </form>

                {{-- Este botão "Entrar" só aparece se não estiver logado – remover ou ajustar --}}
                @guest
                <form method="GET" action="{{ route('login') }}">
                    <button class="text-xs text-green-400 hover:text-green-300">
                        Entrar
                    </button>
                </form>
                @endguest

            </div>
        </div>

    </aside>

    {{-- ================= MAIN ================= --}}
    <div class="flex-1 flex flex-col">
        <main class="flex-1 overflow-y-auto p-6 bg-fundo-secao">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

</div>

</body>
</html>