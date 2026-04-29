<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Hotéis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-fundo-secao text-texto-escuro min-h-screen font-sans">

    <!-- NAVBAR -->
    <header class="bg-gradient-to-br from-primaria-dark via-primaria to-primaria-light h-16 px-8 flex items-center justify-between sticky top-0 z-50 shadow-lg text-white">

            <!-- LOGO -->
            <h1 class="text-white text-xl font-bold">
                
            </h1>

            <!-- MENU -->
            <nav class="flex items-center gap-6">

               
                <a href="/" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-acento hover:border-acento transition-all duration-200">

                    Início
                </a>
        
                
                <a href="/hoteis" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-acento hover:border-acento transition-all duration-200">

                    Hotéis
                </a>
           
           
                <a href="{{ route('user.pontosturisticos.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-acento hover:border-acento transition-all duration-200">

                    Pontos Turísticos
                </a>
           
                <a href="{{ route('user.culturas.index') }}" class="block hover:text-primaria">
                    Culturas
                </a>
         
               

                @auth
                    <a href="/dashboard"
                       class="bg-primaria text-white px-4 py-2 rounded-lg hover:bg-primaria-dark transition">
                        Dashboard
                    </a>
                @else
                    <a href="/login"
                       class="border border-primaria text-white px-4 py-2 rounded-lg hover:bg-primaria hover:text-white transition">
                        Entrar
                    </a>
                @endauth

            </nav>
        </div>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    </header>

    <!-- HERO SIMPLES (no teu estilo) -->
    <section class="bg-primaria-dark py-20 px-8 text-center relative overflow-hidden text-white">
        <div class="w-2xl mx-auto relative z-10 h-20">

            <h2 class="text-2xl font-bold mb-2">
                Encontra os melhores hotéis
            </h2>

            <p class="text-white/90 mt-2 text-sm">
                Conforto, qualidade e preços acessíveis para a tua estadia
            </p>
            <br> 

            <form method="GET" action="{{ route('user.hoteis.index') }}" class="mb-4">
    <input 
        type="text" 
        name="search" 
        placeholder="Pesquisar hotéis..." 
        value="{{ request('search') }}"              {{-- tamanho da barra de pesquisa --}}
        class=" border border-primaria text-black px-4 py-2 rounded-lg w-1/2">

    <button type="submit" class="bg-primaria text-white px-4 py-2 rounded">
        Pesquisar
    </button>
</form>
        </div>
    </section>

    <!-- CONTEÚDO -->
    <main class="max-w-7xl mx-auto px-6 py-10">

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-5 text-center text-sm text-gray-500">
            © {{ date('Y') }} HotelFinder - Todos os direitos reservados
        </div>
    </footer>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</body>
</html>