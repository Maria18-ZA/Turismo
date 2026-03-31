<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Turismo Angola</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<!-- HEADER -->
<header class="bg-gray-900 text-white h-24 flex items-center justify-center shadow-md">
    <h1 class="text-2xl md:text-3xl font-bold tracking-wide">
        Turismo em Luanda
    </h1>
</header>

<!-- MENU -->
<nav class="bg-white shadow-md flex justify-center space-x-8 py-4 sticky top-0 z-50">
    <a href="{{ route('hoteis.index') }}" class="font-semibold hover:text-blue-600 transition duration-300">Hotéis</a>
    <a href="{{ route('pontosturisticos.index') }}" class="font-semibold hover:text-blue-600 transition duration-300">Pontos Turísticos</a>
    <a href="#" class="font-semibold hover:text-blue-600 transition duration-300">Cultura</a>
</nav>

<!-- BANNER -->
<section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-16">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Destaque da Semana</h1>
    <p class="text-lg md:text-xl mb-6">Explore praias, ilhas, museus e muito mais</p>

    <a href="{{ route('pontosturisticos.index') }}"
       class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-gray-200 transition">
        Explorar agora
    </a>
</section>

<div class="px-6 py-10 space-y-12">

<!-- PRAIAS -->
<section>
<h2 class="text-2xl font-bold mb-4">🌊 Praias</h2>

<div class="flex gap-6 overflow-x-auto pb-4">

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg hover:scale-105 transition">
        <h3 class="text-lg font-semibold">Ilha do Mussulo</h3>
        <p class="text-sm">Praias calmas e muito visitadas em Luanda.</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg hover:scale-105 transition">
        <h3 class="text-lg font-semibold">Praia do Cabo Ledo</h3>
        <p class="text-sm">Ondas perfeitas e paisagem incrível.</p>
    </div>

</div>
</section>

<!-- ILHAS -->
<section>
<h2 class="text-2xl font-bold mb-4">🏝️ Ilhas</h2>

<div class="flex gap-6 overflow-x-auto pb-4">

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg hover:scale-105 transition">
        <h3 class="text-lg font-semibold">Ilha de Luanda</h3>
        <p class="text-sm">Restaurantes e lazer à beira-mar.</p>
    </div>

</div>
</section>

<!-- MUSEUS -->
<section>
<h2 class="text-2xl font-bold mb-4">🏛️ Museus</h2>

<div class="flex gap-6 overflow-x-auto pb-4">

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg hover:scale-105 transition">
        <h3 class="text-lg font-semibold">Museu Nacional</h3>
        <p class="text-sm">Cultura e tradição angolana.</p>
    </div>

</div>
</section>

<!-- HOTEIS -->
<section>
<h2 class="text-2xl font-bold mb-4">🏨 Hotéis</h2>

<div class="flex gap-6 overflow-x-auto pb-4">

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg hover:scale-105 transition">
        <h3 class="text-lg font-semibold">Hotel Epic Sana</h3>
        <p class="text-sm">Vista moderna para o mar.</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg hover:scale-105 transition">
        <h3 class="text-lg font-semibold">Hotel Trópico</h3>
        <p class="text-sm">Conforto e localização ideal.</p>
    </div>

</div>
</section>

</div>

</body>
</html>