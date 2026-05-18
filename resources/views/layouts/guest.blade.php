<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Visita Já') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-slate-800 via-blue-900 to-slate-900 min-h-screen">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            
            <!-- Logo com estilo -->
            <div class="mb-8">
                <a href="/" class="flex flex-col items-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-all duration-300 transform group-hover:scale-105">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="mt-3 text-xl font-bold text-white tracking-tight">{{ config('app.name', 'Visita Já') }}</span>
                </a>
            </div>

            <!-- Card principal -->
            <div class="w-full sm:max-w-md px-8 py-8 bg-white/95 backdrop-blur-sm shadow-2xl shadow-black/20 overflow-hidden sm:rounded-2xl border border-white/20">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-sm text-white/50">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Visita Já') }}. Todos os direitos reservados.
                </p>
            </div>
        </div>
    </body>
</html>