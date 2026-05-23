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
<section class="bg-gradient-to-r from-blue-900 to-blue-700 py-16 md:py-20 px-4 text-center relative overflow-hidden">
    <div class="max-w-3xl mx-auto relative z-10">
        <h2 class="text-white text-3xl md:text-5xl font-black leading-tight mb-3">Descubra Luanda</h2>
        <p class="text-blue-100 text-base md:text-lg leading-relaxed mb-6 max-w-lg mx-auto">
            Explore a capital angolana: praias paradisíacas, monumentos históricos, museus fascinantes e a vibrante cultura luandense.
        </p>
        <a href="#praias" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold py-2 px-6 rounded-full transition duration-300 shadow-md">
            Explorar Roteiros 
        </a>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 py-10 space-y-12">
    <!-- PRAIAS -->
    <section id="praias">
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Praias imperdíveis de Luanda</h2>
        <div class="flex gap-6 pb-4 ">
            
            <!-- Mussulo - Praia mais famosa de Luanda -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/32/6a/68/praia-do-mussulo.jpg" class="h-48 w-1/2 object-cover" alt="Praia do Mussulo, Luanda" onerror="this.src='https://images.unsplash.com/photo-1500375592092-40eb2168fd21'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Praia do Mussulo</h3>
                    <p class="text-sm text-gray-600 mt-1">Ilha paradisíaca com águas calmas e areia branca. O destino mais procurado pelos luandenses aos fins de semana.</p>
                    <a href="https://pt.wikipedia.org/wiki/Mussulo" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais </a>
                </div>
            </div>

            <!-- Cabo Ledo -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/12/24/0e/38/praia-do-cabo-ledo.jpg" class="h-48 w-full object-cover" alt="Praia do Cabo Ledo, Luanda" onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Praia do Cabo Ledo</h3>
                    <p class="text-sm text-gray-600 mt-1">Um dos melhores spots de surf em Angola, com ondas perfeitas e paisagem deslumbrante a 120km de Luanda.</p>
                    <a href="https://pt.wikipedia.org/wiki/Cabo_Ledo" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais →</a>
                </div>
            </div>

            <!-- Ilha de Luanda -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/a3/97/dd/ilha-de-luanda.jpg" class="h-48 w-full object-cover" alt="Ilha de Luanda" onerror="this.src='https://images.unsplash.com/photo-1500375592092-40eb2168fd21'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Ilha de Luanda</h3>
                    <p class="text-sm text-gray-600 mt-1">Praia urbana com excelente gastronomia, bares e vida noturna. O ponto de encontro dos luandenses.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais →</a>
                </div>
            </div>

            <!-- Praia da Samba -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/0d/db/63/c1/praia-da-samba.jpg" class="h-48 w-full object-cover" alt="Praia da Samba, Luanda" onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Praia da Samba</h3>
                    <p class="text-sm text-gray-600 mt-1">Praia familiar com infraestrutura completa e mar calmo, ideal para crianças.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber mais →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- PONTOS TURÍSTICOS -->
    <section>
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Pontos Turísticos de Luanda</h2>
        <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-thin">
            
            <!-- Fortaleza de São Miguel -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Fortaleza_de_Sao_Miguel_Luanda_Angola_(cropped).jpg/1200px-Fortaleza_de_Sao_Miguel_Luanda_Angola_(cropped).jpg" class="h-48 w-full object-cover" alt="Fortaleza de São Miguel" onerror="this.src='https://images.unsplash.com/photo-1542314831-068cd1dbfeeb'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Fortaleza de São Miguel</h3>
                    <p class="text-sm text-gray-600">Construída em 1576, é o mais importante monumento histórico de Luanda e abriga o Museu Central das Forças Armadas.</p>
                    <a href="https://pt.wikipedia.org/wiki/Fortaleza_de_S%C3%A3o_Miguel_(Luanda)" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Visitar →</a>
                </div>
            </div>

            <!-- Palácio de Ferro -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Pal%C3%A1cio_de_Ferro_%281%29.jpg/1200px-Pal%C3%A1cio_de_Ferro_%281%29.jpg" class="h-48 w-full object-cover" alt="Palácio de Ferro" onerror="this.src='https://images.unsplash.com/photo-1542314831-068cd1dbfeeb'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Palácio de Ferro</h3>
                    <p class="text-sm text-gray-600">Projetado por Gustave Eiffel, uma joia arquitetônica no centro de Luanda.</p>
                    <a href="https://pt.wikipedia.org/wiki/Pal%C3%A1cio_de_Ferro" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Ver mais →</a>
                </div>
            </div>

            <!-- Memorial António Agostinho Neto -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Memorial_Ant%C3%B3nio_Agostinho_Neto_%284%29.jpg/1280px-Memorial_Ant%C3%B3nio_Agostinho_Neto_%284%29.jpg" class="h-48 w-full object-cover" alt="Memorial Agostinho Neto" onerror="this.src='https://images.unsplash.com/photo-1551882547-ff40c63fe5fa'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Memorial Agostinho Neto</h3>
                    <p class="text-sm text-gray-600">Imponente monumento em homenagem ao primeiro presidente de Angola, com museu e vista panorâmica da cidade.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Conhecer →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- MUSEUS DE LUANDA (COM MUSEU DA ESCRAVATURA CORRIGIDO) -->
    <section>
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Museus de Luanda</h2>
        <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-thin">
            
            <!-- Museu Nacional de História Natural de Angola -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Museu_de_Hist%C3%B3ria_Natural_de_Angola_%281%29.jpg/1280px-Museu_de_Hist%C3%B3ria_Natural_de_Angola_%281%29.jpg" class="h-48 w-full object-cover" alt="Museu de História Natural de Angola" onerror="this.src='https://images.unsplash.com/photo-1529156069898-49953e39b3ac'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Museu de História Natural</h3>
                    <p class="text-sm text-gray-600">Importante acervo da fauna, flora e geologia angolana. Localizado no Ingombota, Luanda.</p>
                    <a href="https://pt.wikipedia.org/wiki/Museu_Nacional_de_Hist%C3%B3ria_Natural_de_Angola" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Visitar museu →</a>
                </div>
            </div>

            <!-- Museu Nacional da Escravatura - IMAGEM CORRIGIDA (Alamy Stock Photo CBF17R) -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://c8.alamy.com/comp/CBF17R/musee-national-de-lesclavage-a-luanda-angola-CBF17R.jpg" class="h-48 w-full object-cover" alt="Museu Nacional da Escravatura, Morro da Cruz, Luanda" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Museu_da_Escravatura_-_Luanda_%28cropped%29.jpg/1280px-Museu_da_Escravatura_-_Luanda_%28cropped%29.jpg'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Museu da Escravatura</h3>
                    <p class="text-sm text-gray-600">Localizado no Morro da Cruz, documenta a história trágica da escravatura em Angola e o tráfico negreiro. Inaugurado em 1997.[citation:1][citation:9]</p>
                    <a href="https://pt.wikipedia.org/wiki/Museu_Nacional_da_Escravatura" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Saber história →</a>
                </div>
            </div>

            <!-- Museu de Antropologia -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Museu_Nacional_de_Antropologia_%28Angola%29.jpg/1280px-Museu_Nacional_de_Antropologia_%28Angola%29.jpg" class="h-48 w-full object-cover" alt="Museu Nacional de Antropologia" onerror="this.src='https://images.unsplash.com/photo-1504609813442-a8924e83f76e'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Museu de Antropologia</h3>
                    <p class="text-sm text-gray-600">Preserva e exibe a diversidade das culturas e tradições dos povos de Angola.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Explorar →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- HOTÉIS -->
    <section>
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Hotéis de excelência em Luanda</h2>
        <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-thin">
            
            <!-- Epic Sana Luanda -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/359238933.jpg" class="h-48 w-full object-cover" alt="Epic Sana Luanda Hotel" onerror="this.src='https://images.unsplash.com/photo-1542314831-068cd1dbfeeb'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">EPIC SANA Luanda</h3>
                    <p class="text-sm text-gray-600">Hotel 5 estrelas com vista deslumbrante para a Baía de Luanda e serviços premium.</p>
                    <a href="https://www.epic.sanahotels.com" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Reservar →</a>
                </div>
            </div>

            <!-- Hotel Trópico -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/252073744.jpg" class="h-48 w-full object-cover" alt="Hotel Trópico Luanda" onerror="this.src='https://images.unsplash.com/photo-1551882547-ff40c63fe5fa'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Hotel Trópico</h3>
                    <p class="text-sm text-gray-600">Localizado no centro da cidade, conforto e requinte com vista para o Porto de Luanda.</p>
                    <a href="https://www.hotel-tropico.ao" target="_blank" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Ver ofertas →</a>
                </div>
            </div>

            <!-- Hotel Presidente Luanda -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/143672554.jpg" class="h-48 w-full object-cover" alt="Hotel Presidente Luanda" onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Hotel Presidente</h3>
                    <p class="text-sm text-gray-600">Hotel emblemático no coração de Luanda, com fácil acesso aos principais pontos turísticos.</p>
                    <a href="#" class="inline-block mt-3 text-blue-600 hover:text-yellow-600 text-sm font-medium">Reservar →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CULTURA E TRADIÇÃO -->
    <section>
        <h2 class="text-2xl md:text-3xl font-bold mb-6 border-l-4 border-yellow-500 pl-3">Cultura e Tradição de Luanda</h2>
        <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-thin">
            
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1535463731090-e34f4b5098c6" class="h-48 w-full object-cover" alt="Dança Semba em Luanda" onerror="this.src='https://images.unsplash.com/photo-1504609813442-a8924e83f76e'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Semba e Kizomba</h3>
                    <p class="text-sm text-gray-600">A capital do Semba e berço da Kizomba. Ritmos contagiantes que nasceram nas tradições angolanas.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1486572788966-cfd3df1f5b42" class="h-48 w-full object-cover" alt="Artesanato angolano" onerror="this.src='https://images.unsplash.com/photo-1529156069898-49953e39b3ac'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Artesanato e Cultura</h3>
                    <p class="text-sm text-gray-600">Máscaras, esculturas e peças únicas nos mercados de Luanda, como o Benfica e São Paulo.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition w-80 flex-shrink-0 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0" class="h-48 w-full object-cover" alt="Gastronomia luandense" onerror="this.src='https://images.unsplash.com/photo-1555939594-58d7cb561ad1'">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Gastronomia Luandense</h3>
                    <p class="text-sm text-gray-600">Moamba de galinha, funge, calulu e frutos do mar frescos da Ilha de Luanda.</p>
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

<!-- Scrollbar personalizada -->
<style>
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