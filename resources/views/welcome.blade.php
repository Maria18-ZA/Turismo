<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descubra o melhor do turismo em Luanda, Angola: praias, hotéis, pontos turísticos e cultura.">
    <title>Visita Já</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-fundo-secao text-texto-escuro min-h-screen font-sans">

    
<header class="bg-primaria h-16 px-8 flex justify-between sticky top-0 z-50 text-white">
    <h1 class="text-white text-xl font-bold font-sans  py-4">Visita Já</h1>

    <!-- MENU/ links da pagina inicial -->
    <nav class="flex items-center gap-6">
                
                <a href="{{ route('user.hoteis.index') }}" class="text-white/85 text-sm font-medium  hover:text-acento ">

                    Hotéis
                </a>
           
           
                <a href="{{ route('user.pontosturisticos.index') }}" class="text-white/85 text-sm font-medium  hover:text-acento">

                    Pontos Turísticos
                </a>
           
                <a href="{{ route('user.culturas.index') }}" class="text-white/85 text-sm font-medium  hover:text-acento">
                    Culturas
                </a>
    </nav>
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
    </section>
<br><br>

  @foreach($places as $place)

<div class="bg-white rounded-2xl overflow-hidden border hover:shadow-xl transition flex flex-col">

    <img src="{{ $place->imagem }}"
         class="w-full h-48 object-cover">

    <div class="p-5 flex flex-col flex-1">

        <span class="text-xs bg-yellow-500 text-white px-2 py-1 rounded-full w-fit">
            {{ $place->categoria }}
        </span>

        <h3 class="text-lg font-bold mt-2">
            {{ $place->titulo }}
        </h3>

        <p class="text-sm text-gray-600 mt-2 flex-1">
            {{ $place->descricao }}
        </p>

        @if($place->link)
        <a href="{{ $place->link }}"
           target="_blank"
           class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg text-center">
            Saber mais
        </a>
        @endif

    </div>

</div>

@endforeach
<!-- FOOTER -->
<footer class="bg-gray-800 border-t mt-10">
    <div class="max-w-7xl mx-auto px-6 py-5 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Visita Já - Descubra Luanda com autenticidade.</p>
        <p class="mt-2 text-gray-500">Um projecto para valorizar os destinos e a cultura angolana.</p>
    </div>
</footer>

</body>
</html>