<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descubra o melhor do turismo em Luanda, Angola: praias, hotéis, pontos turísticos e cultura.">
    <title>Turismo Angola | Luanda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen font-sans antialiased">

<!-- HEADER -->
<header class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 h-16 px-4 md:px-8 flex items-center justify-between sticky top-0 z-50 shadow-lg">
    <h1 class="text-white text-xl font-bold tracking-tight">Turismo em Luanda</h1>

    <!-- MENU SEMÂNTICO -->
    <nav aria-label="Menu principal">
        <ul class="flex items-center gap-4 md:gap-6">
            <li><a href="{{ route('user.hoteis.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-yellow-400 hover:border-yellow-400 transition-all duration-200">Hotéis</a></li>
            <li><a href="{{ route('user.pontosturisticos.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-yellow-400 hover:border-yellow-400 transition-all duration-200">Pontos Turísticos</a></li>
            <li><a href="{{ route('user.culturas.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-yellow-400 hover:border-yellow-400 transition-all duration-200">Cultura</a></li>
        </ul>
    </nav>
</header>

<!-- BANNER (Destaque da semana) -->
<section class="bg-blue-900 py-16 md:py-20 px-4 text-center relative overflow-hidden">
    <div class="max-w-3xl mx-auto relative z-10">
        <h2 class="text-white text-3xl md:text-5xl font-black leading-tight mb-3">Destaque da Semana</h2>
        <p class="text-blue-100 text-base md:text-lg leading-relaxed mb-6 max-w-lg mx-auto">
            Explore praias paradisíacas, ilhas deslumbrantes, museus históricos e a vibrante cultura angolana.
        </p>
        <a href="#praias" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold py-2 px-6 rounded-full transition duration-300 shadow-md">
            Explorar Roteiros 
        </a>
    </div>
    <!-- Elemento decorativo (opcional) -->
    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml,%3Csvg...')] pointer-events-none"></div>
</section>

<main class="max-w-7xl mx-auto px-4 py-10 space-y-12">
    <!-- PRAIAS -->
    <section id="praias">
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Praias imperdíveis</h2>
        <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-thin">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Praia do Mussulo</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Praia do Mussulo</h3>
                    <p class="text-sm text-gray-600 mt-1">Vista moderna para o mar, areias claras e águas calmas.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais →</a>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Praia do Cabo Ledo</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Praia do Cabo Ledo</h3>
                    <p class="text-sm text-gray-600 mt-1">Ondas perfeitas para surf, paisagem selvagem e incrível.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais →</a>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Praia de Luanda</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Praia de Luanda</h3>
                    <p class="text-sm text-gray-600 mt-1">Praia calma, muito visitada e com excelente estrutura.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- HOTÉIS -->
    <section>
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Hotéis de excelência</h2>
        <div class="flex gap-6 overflow-x-auto pb-4">
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Hotel Epic Sana</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Hotel Epic Sana</h3>
                    <p class="text-sm text-gray-600">Vista panorâmica para o mar e serviços premium.</p>
                    <a href="user.hoteis.show" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Ver ofertas →</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Hotel Trópico</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Hotel Trópico</h3>
                    <p class="text-sm text-gray-600">Conforto incomparável e localização central em Luanda.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Ver ofertas →</a>
                </div>
            </div>
            <!-- Adicione mais hotéis se desejar -->
        </div>
    </section>

    <!-- CULTURA (nova secção para alinhar com o menu) -->
    <section>
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Cultura e Tradição</h2>
        <div class="flex gap-6 overflow-x-auto pb-4">
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Museu da Escravatura</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Museu da Escravatura</h3>
                    <p class="text-sm text-gray-600">Memória histórica e reflexão sobre o passado angolano.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Visitar →</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Semba e Kizomba</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Danças Angolanas</h3>
                    <p class="text-sm text-gray-600">Vivência do semba, kizomba e festas tradicionais.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Ver agenda →</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 sm:w-64 flex-shrink-0 overflow-hidden">
                <div class="h-40 bg-gray-300 flex items-center justify-center text-gray-500 text-sm">Imagem: Gastronomia</div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Culinária Típica</h3>
                    <p class="text-sm text-gray-600">Moamba de galinha, funge e sabores autênticos.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saborear →</a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- FOOTER -->
<footer class="bg-gray-800 text-gray-300 py-8 mt-12 border-t border-gray-700">
    <div class="max-w-7xl mx-auto px-4 text-center text-sm">
        <p>&copy; {{ date('Y') }} Turismo Angola — Descubra Luanda com autenticidade.</p>
        <p class="mt-2 text-gray-500">Um projecto para valorizar os destinos e a cultura angolana.</p>
    </div>
</footer>

<!-- Scrollbar personalizada (opcional, apenas estética) -->
<style>
    /* Para navegadores Webkit - melhora visual da barra de rolagem horizontal */
    .scrollbar-thin::-webkit-scrollbar {
        height: 6px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
</body>
</html>