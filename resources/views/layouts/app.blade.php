<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Visita Já') }} — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        .sidebar-enter {
            animation: slideIn 0.3s ease-out;
        }
        
        .hover-scale {
            transition: transform 0.2s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Loading Animation */
        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Glassmorphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Dark Mode Styles */
        .dark {
            background-color: #1a1a2e;
            color: #eee;
        }
        
        .dark .bg-fundo-secao {
            background-color: #0f0f1a;
        }
        
        .dark .bg-white {
            background-color: #1a1a2e;
            color: #eee;
        }
        
        .dark .border-gray-200 {
            border-color: #2d2d3a;
        }
        
        .dark .text-gray-600,
        .dark .text-gray-700 {
            color: #ccc;
        }
    </style>
</head>

<body :class="darkMode ? 'dark' : ''" class="bg-gray-50 text-gray-900 font-sans antialiased transition-colors duration-300">

<div class="flex h-screen overflow-hidden">
    
    {{-- ================= SIDEBAR MODERNA ================= --}}
    <aside x-data="{ collapsed: false }" 
           :class="collapsed ? 'w-20' : 'w-72'" 
           class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 border-r border-gray-700 flex flex-col transition-all duration-300 shadow-2xl relative z-10">
        

        
        {{-- BRAND --}}
        <div class="px-6 py-6 border-b border-gray-700" :class="collapsed ? 'text-center' : ''">
            <div class="flex items-center" :class="collapsed ? 'justify-center' : 'justify-between'">
                <div class="flex items-center gap-3" :class="collapsed ? 'flex-col' : ''">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-umbrella-beach text-white text-xl"></i>
                    </div>
                    <div x-show="!collapsed" class="transition-opacity duration-300">
                        <div class="text-white font-black text-xl tracking-wide">
                            {{ config('app.name', 'Visita Já') }}
                        </div>
                        <div class="text-gray-400 text-xs mt-1">
                            <i class="fas fa-shield-alt mr-1"></i>Área Administrativa
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATS CARDS (apenas quando expanded) --}}
        <div x-show="!collapsed" class="px-4 py-4 border-b border-gray-700">
            <div class="grid grid-cols-2 gap-2">
                <div class="bg-gray-800/50 rounded-lg p-2 text-center">
                    <div class="text-blue-400 text-lg font-bold" id="totalHoteis">-</div>
                    <div class="text-gray-400 text-xs">Hotéis</div>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-2 text-center">
                    <div class="text-green-400 text-lg font-bold" id="totalReservas">-</div>
                    <div class="text-gray-400 text-xs">Reservas</div>
                </div>
            </div>
        </div>

        {{-- NAVEGAÇÃO --}}
        <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
            
            @php
                $navItems = [
                    ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'fas fa-tachometer-alt', 'color' => 'text-blue-400'],
                    ['name' => 'Hotéis', 'route' => 'hoteis.index', 'icon' => 'fas fa-hotel', 'color' => 'text-cyan-400'],
                    ['name' => 'Quartos', 'route' => 'quartos.index', 'icon' => 'fas fa-bed', 'color' => 'text-teal-400'],
                    ['name' => 'Reservas', 'route' => 'reservas.index', 'icon' => 'fas fa-calendar-check', 'color' => 'text-green-400'],
                    ['name' => 'Serviços', 'route' => 'servicos.index', 'icon' => 'fas fa-concierge-bell', 'color' => 'text-yellow-400'],
                    ['name' => 'Pontos Turísticos', 'route' => 'pontosturisticos.index', 'icon' => 'fas fa-map-marked-alt', 'color' => 'text-purple-400'],
                    ['name' => 'Culturas', 'route' => 'culturas.index', 'icon' => 'fas fa-music', 'color' => 'text-pink-400'],
                    ['name' => 'Avaliações', 'route' => 'avaliacoes.index', 'icon' => 'fas fa-star', 'color' => 'text-orange-400'],
                ];
            @endphp

            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group relative
                          {{ request()->routeIs($item['route'] . '*') 
                              ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' 
                              : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    
                    <i class="{{ $item['icon'] }} text-lg w-5 {{ request()->routeIs($item['route'] . '*') ? 'text-white' : $item['color'] }}"></i>
                    
                    <span x-show="!collapsed" class="transition-opacity duration-300">{{ $item['name'] }}</span>
                    
               
                </a>
            @endforeach
        </nav>

        {{-- USER PANEL MELHORADO --}}
        <div class="border-t border-gray-700 p-4">
            <div x-data="{ userMenuOpen: false }" class="relative">
                <button @click="userMenuOpen = !userMenuOpen" 
                        class="flex items-center gap-3 w-full p-2 rounded-xl hover:bg-gray-800 transition group">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                        </div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></div>
                    </div>
                    
                    <div x-show="!collapsed" class="flex-1 text-left">
                        <div class="text-white text-sm font-semibold truncate">
                            {{ auth()->user()->name ?? 'Usuário' }}
                        </div>
                        <div class="text-gray-400 text-xs">
                            <i class="fas {{ auth()->user()->role === 'admin' ? 'fa-crown' : 'fa-user-tie' }} mr-1"></i>
                            {{ ucfirst(auth()->user()->role ?? 'Turista') }}
                        </div>
                    </div>
                    
                    <i x-show="!collapsed" 
                       :class="userMenuOpen ? 'fa-chevron-up' : 'fa-chevron-down'"
                       class="fas text-gray-400 text-xs transition-transform"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="userMenuOpen" 
                     @click.away="userMenuOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="absolute bottom-full left-0 right-0 mb-2 bg-gray-800 rounded-xl shadow-xl overflow-hidden z-20">
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 transition">
                        <i class="fas fa-user-circle w-5"></i>
                        <span class="text-sm">Meu Perfil</span>
                    </a>
                    
                    <a href="#" onclick="toggleDarkMode()" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 transition">
                        <i class="fas fa-moon w-5"></i>
                        <span class="text-sm">Modo Escuro</span>
                    </a>
                    
                    <hr class="border-gray-700">
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-gray-700 transition w-full">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="text-sm">Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        
        {{-- TOP BAR --}}
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="px-6 py-4 flex items-center justify-between">
                
                {{-- Page Title --}}
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        @yield('page-description', 'Bem-vindo ao painel de controlo')
                    </p>
                </div>
                
                {{-- Right Side Actions --}}
                <div class="flex items-center gap-4">
                    
                    {{-- Search Bar --}}
                    <div class="hidden md:block relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" 
                               placeholder="Pesquisar..." 
                               id="globalSearch"
                               class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-gray-50 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                    </div>
                    
                    {{-- Notifications --}}
                    <div x-data="{ notifOpen: false }" class="relative">
                        <button @click="notifOpen = !notifOpen" 
                                class="relative p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </button>
                        
                        <div x-show="notifOpen" 
                             @click.away="notifOpen = false"
                             x-transition
                             class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-2xl z-50 border border-gray-200 dark:border-gray-700">
                            <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="font-semibold">Notificações</h3>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                                    <p class="text-sm">📅 Nova reserva recebida</p>
                                    <p class="text-xs text-gray-500 mt-1">Há 5 minutos</p>
                                </div>
                                <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                                    <p class="text-sm">⭐ Nova avaliação no hotel</p>
                                    <p class="text-xs text-gray-500 mt-1">Há 1 hora</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Dark Mode Toggle --}}
                    <button onclick="toggleDarkMode()" 
                            class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                        <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'" class="text-xl"></i>
                    </button>
                </div>
            </div>
        </header>

        {{-- CONTENT AREA --}}
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
            <div class="max-w-7xl mx-auto animate-fade-in">
                @yield('content')
            </div>
        </main>
        
        {{-- FOOTER --}}
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-3 px-6">
            <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                <div>
                    <i class="fas fa-copyright mr-1"></i> {{ date('Y') }} {{ config('app.name', 'Visita Já') }} - Todos os direitos reservados
                </div>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-blue-500 transition">Termos</a>
                    <a href="#" class="hover:text-blue-500 transition">Privacidade</a>
                    <span>Versão 2.0.0</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<script>
    // Dark Mode Toggle
    function toggleDarkMode() {
        const isDark = localStorage.getItem('darkMode') === 'true';
        localStorage.setItem('darkMode', !isDark);
        location.reload();
    }
    
    // Load stats dynamically
    async function loadStats() {
        try {
            const response = await fetch('/api/stats');
            const data = await response.json();
            
            document.getElementById('totalHoteis')?.textContent = data.totalHoteis || 0;
            document.getElementById('totalReservas')?.textContent = data.totalReservas || 0;
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }
    
    // Global search
    document.getElementById('globalSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const currentPage = window.location.pathname;
        
        if (currentPage.includes('hoteis')) {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }
    });
    
    // Load stats when page loads
    if (document.getElementById('totalHoteis')) {
        loadStats();
        
        // Refresh stats every 30 seconds
        setInterval(loadStats, 30000);
    }
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + D = Dashboard
        if (e.ctrlKey && e.key === 'd') {
            window.location.href = "{{ route('dashboard') }}";
        }
        // Ctrl + H = Hotéis
        if (e.ctrlKey && e.key === 'h') {
            window.location.href = "{{ route('hoteis.index') }}";
        }
        // Ctrl + R = Reservas
        if (e.ctrlKey && e.key === 'r') {
            window.location.href = "{{ route('reservas.index') }}";
        }
    });
    
    // Welcome toast
    window.addEventListener('load', function() {
        const lastVisit = localStorage.getItem('lastVisit');
        const today = new Date().toDateString();
        
        if (lastVisit !== today) {
            console.log('🎉 Bem-vindo ao painel administrativo!');
            localStorage.setItem('lastVisit', today);
        }
    });
</script>

@stack('scripts')

</body>
</html>