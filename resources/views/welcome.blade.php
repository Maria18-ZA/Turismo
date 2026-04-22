<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Turismo Angola</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-fundo-secao text-texto-escuro min-h-screen font-sans">

<!-- HEADER -->
<header class="bg-gradient-to-br from-primaria-dark via-primaria to-primaria-light h-16 px-8 flex items-center justify-between sticky top-0 z-50 shadow-lg">
    <h1 class="text-white text-xl font-bold">
        Turismo em Luanda
    </h1>


<!-- MENU -->
<nav class="flex items-center gap-6">
    
<a href="{{ route('user.hoteis.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-acento hover:border-acento transition-all duration-200">Hotéis</a>


    <a href="{{ route('user.pontosturisticos.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-acento hover:border-acento transition-all duration-200">Pontos Turísticos</a>

    <a href="{{ route('user.culturas.index') }}" class="text-white/85 text-sm font-medium border-b-2 border-transparent hover:text-acento hover:border-acento transition-all duration-200">Cultura</a>
</nav>
</header>

<!-- BANNER -->
<section class="bg-primaria-dark py-20 px-8 text-center relative overflow-hidden text-white">
    <h1 class="text-white text-4xl md:text-5xl font-black leading-tight mb-3">Destaque da Semana</h1>
    <p class="text-white text-base md:text-lg leading-relaxed mb-4 max-w-lg mx-auto">Explore praias, ilhas, museus e muito mais</p>

    
</section>

<div class="max-w-2xl mx-auto relative z-10  ">

<!-- PRAIAS -->
<section>
<h2 class="text-2xl font-bold mb-4">🌊 Praias</h2>

<div class="flex gap-6  pb-4 w-100">

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg ">
        <h3 class="text-lg font-semibold">Praia do Mussulo</h3>
        <p class="text-sm">Vista moderna para o mar.</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg ">
        <h3 class="text-lg font-semibold">Praia do Cabo Ledo</h3>
        <p class="text-sm">Ondas perfeitas e paisagem incrível.</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg ">
        <h3 class="text-lg font-semibold">Praia de Luanda</h3>
        <p class="text-sm">Praia calma e muito visitada em Luanda.</p>
    </div>

</div>
</section>

<!-- HOTEIS -->
<section>
<h2 class="text-2xl font-bold mb-4">🏨 Hotéis</h2>

<div class="flex gap-6 overflow-x-auto pb-4">

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg ">
        <h3 class="text-lg font-semibold">Hotel Epic Sana</h3>
        <p class="text-sm">Vista moderna para o mar.</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow w-64 hover:shadow-lg ">
        <h3 class="text-lg font-semibold">Hotel Trópico</h3>
        <p class="text-sm">Conforto e localização ideal.</p>
    </div>

</div>
</section>

</div>

</body>
</html>