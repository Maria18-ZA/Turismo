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