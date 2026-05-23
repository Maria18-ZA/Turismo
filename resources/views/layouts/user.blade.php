<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Visita Já</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-fundo-secao text-texto-escuro min-h-screen font-sans">

    <!-- NAVBAR -->
    <header class="bg-primaria h-16 px-8 flex justify-between sticky top-0 z-50 text-white">

            <!-- LOGO -->
            <h1 class="text-white text-xl font-bold font-sans  py-4">
                Visita Já
            </h1>

            <!-- MENU, links -->
            <nav class="flex items-center gap-6">

               
                <a href="/" class="text-white/85 text-sm font-medium  hover:text-acento ">

                    Início
                </a>
        
                
                <a href="{{ route('user.hoteis.index') }}" class="text-white/85 text-sm font-medium  hover:text-acento ">

                    Hotéis
                </a>
           
           
                <a href="{{ route('user.pontosturisticos.index') }}" class="text-white/85 text-sm font-medium  hover:text-acento">

                    Pontos Turísticos
                </a>
           
                <a href="{{ route('user.culturas.index') }}" class="text-white/85 text-sm font-medium  hover:text-acento">
                    Culturas
                </a>
         
               

              @auth
    @php
        $user = auth()->user();
        $isAdminOrGestor = false;
        
        // Verificar se o usuário tem role admin ou gestor
        if (method_exists($user, 'hasRole')) {
            $isAdminOrGestor = $user->hasRole('admin') || $user->hasRole('gestor');
        } elseif (isset($user->role)) {
            $isAdminOrGestor = in_array($user->role, ['admin', 'gestor']);
        }
    @endphp
    
    @if($isAdminOrGestor)
        <a href="{{ route('dashboard') }}"
           class="bg-primaria text-white px-4 py-2 rounded-lg hover:bg-primaria-dark transition">
            Dashboard
        </a>
    @else
        <a href="{{ route('user.hoteis.index') }}"
           class="bg-primaria text-white px-4 py-2 rounded-lg hover:bg-primaria-dark transition">
            Explorar Hotéis
        </a>
    @endif
@else
    <a href="{{ route('login') }}"
       class="border border-primaria text-white px-4 py-2 rounded-lg hover:bg-primaria transition">
        Entrar
    </a>
@endauth

            </nav>
        </div>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    </header>

    <!-- HERO SIMPLES (no teu estilo) -->
    <section class="bg-primaria-dark py-20 px-8 text-center text-white">
        <div class="w-2xl mx-auto  h-20">

            <h2 class="text-2xl font-bold mb-2">
                Encontra os melhores hotéis
            </h2>

            <p class="text-white/90 mt-2 text-sm">
                Conforto, qualidade e preços acessíveis para a tua estadia
            </p>
            <br> 

    {{-- Campo ou barra de pesquisa --}}
            <form method="GET" action="{{ route('user.hoteis.index') }}" class="mb-4">
    <input 
        type="text" 
        name="search" 
        placeholder="Pesquisar hotéis..." 
        value="{{ request('search') }}"              {{-- tamanho da barra de pesquisa --}}
        class=" border-primaria text-black px-4 py-2 rounded-lg w-1/2">

    <button type="submit" class="bg-primaria text-white px-4 py-2 rounded">
        Pesquisar
    </button>
</form>
        </div>
    </section>

    <!-- CONTEÚDO ou roganizacao do estilo da pagina em si -->
    <main class="max-w-7xl mx-auto px-6 py-10">

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-5 text-center text-sm text-gray-500">
            © {{ date('Y') }} Visita Já - Todos os direitos reservados
        </div>
    </footer>

    <!-- mapa -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</body>
</html>