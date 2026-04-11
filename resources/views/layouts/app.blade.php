<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Luanda Tourism') }} — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-red-50 text-stone-800">

<div class="flex h-screen overflow-hidden">

    {{-- ========== SIDEBAR ========== --}}
    <aside class="w-56 bg-primaria-dark-950 flex flex-col flex-shrink-0 border-r border-stone-800   ">

        {{-- Brand --}}
        <div class="px-4 py-5 border-b border-stone-800">
            <p class="text-amber-400 font-semibold text-sm tracking-wide">
                {{ config('app.name', 'Luanda Tourism') }}
            </p>
            <p class="text-amber-800 text-xs mt-0.5">Plataforma de Turismo</p>
        </div>


{{-- Nav --}}
<nav class="flex-1 px-2 py-3 overflow-y-auto space-y-0.5">

    <p class="px-2 pt-2 pb-1 text-[10px] font-semibold uppercase tracking-widest text-primaria opacity-60">
        Principal
    </p>
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('dashboard') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Dashboard
    </a>

    <p class="px-2 pt-4 pb-1 text-[10px] font-semibold uppercase tracking-widest text-primaria opacity-60">
        Gestão
    </p>
    <a href="{{ route('hoteis.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('hoteis.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        Hotéis
    </a>

     <a href="{{ route('servicos.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('servicos.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        Serviços
    </a>


    <a href="{{ route('pontosturisticos.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('pontosturisticos.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Pontos Turísticos
    </a>

   <a href="{{ route('culturas.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('culturas.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Culturas
    </a>


    </a>
    <a href="{{ route('avaliacoes.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('avaliacoes.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Avaliações
    </a>

    
    <p class="px-2 pt-4 pb-1 text-[10px] font-semibold uppercase tracking-widest text-primaria opacity-60">
        Reservas
    </p>
    <a href="{{ route('reservas.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('reservas.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Reservas
    </a>

    <a href="{{ route('quartos.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('quartos.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Quartos
    </a>

    @if(auth()->user()?->is_admin)
    <a href="{{ route('users.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm transition-colors duration-150
              {{ request()->routeIs('users.*') 
                  ? 'bg-primaria text-white' 
                  : 'text-primaria-light hover:bg-primaria-dark hover:text-white' }}">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Utilizadores
    </a>
    @endif

</nav>

        {{-- User footer --}}
        <div class="px-2 py-3 border-t border-stone-800">
            <div class="flex items-center gap-2 px-2 py-1.5">
                <div class="w-7 h-7 rounded-full bg-amber-900 text-amber-100 text-xs font-semibold
                            flex items-center justify-center flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-amber-400 text-xs font-medium truncate">
                        {{ auth()->user()?->name ?? 'Utilizador' }}
                    </p>
                    <p class="text-amber-900 text-[10px]">
                        {{ auth()->user()?->is_admin ? 'Administrador' : 'Utilizador' }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                    @csrf
                    <button type="submit" class="text-amber-800 hover:text-amber-400 transition-colors"
                            title="Sair">
                        {{-- <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4" /> --}}
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ========== MAIN AREA ========== --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Header / Topbar --}}
        <header class="bg-amber-50 border-b border-amber-200 px-6 h-14 flex items-center justify-between flex-shrink-0">
            <div>
                <h1 class="text-sm font-semibold text-amber-900">@yield('title', 'Dashboard')</h1>
                <p class="text-[11px] text-amber-600">@yield('breadcrumb', 'Início')</p>
            </div>
            <div class="flex items-center gap-2">
                @yield('header_actions')
            </div>
        </header>

        {{-- Page content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>