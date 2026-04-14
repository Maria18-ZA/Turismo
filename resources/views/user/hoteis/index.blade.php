<div class="flex items-center justify-between mb-8">
    <h1 class="text-texto-escuro text-3xl font-black pb-2 border-b-4 border-primaria-light w-fit">
        Hotéis Disponíveis
    </h1>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800
                text-sm font-medium px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($hoteis as $hotel)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            {{-- IMAGEM --}}
            @if($hotel->imagens->isNotEmpty())
                <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                     class="w-full h-48 object-cover">
            @endif

            <div class="p-4">
                <h2 class="text-lg font-bold text-texto-escuro">
                    {{ $hotel->nome }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ $hotel->localizacao }}
                </p>

                <p class="text-sm mt-2">
                    {{ Str::limit($hotel->descricao, 80) }}
                </p>

                <a href="{{ route('user.hoteis.show', $hotel->id) }}"
                   class="inline-block mt-4 bg-primaria text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primaria-dark transition">
                    Ver Hotel
                </a>
            </div>

        </div>

    @empty
        <p>Nenhum hotel disponível.</p>
    @endforelse

</div><div class="flex items-center justify-between mb-8">
    <h1 class="text-texto-escuro text-3xl font-black pb-2 border-b-4 border-primaria-light w-fit">
        Hotéis Disponíveis
    </h1>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800
                text-sm font-medium px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($hoteis as $hotel)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            {{-- IMAGEM --}}
            @if($hotel->imagens->isNotEmpty())
                <img src="{{ Storage::url($hotel->imagens->first()->imagem) }}"
                     class="w-full h-48 object-cover">
            @endif

            <div class="p-4">
                <h2 class="text-lg font-bold text-texto-escuro">
                    {{ $hotel->nome }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ $hotel->localizacao }}
                </p>

                <p class="text-sm mt-2">
                    {{ Str::limit($hotel->descricao, 80) }}
                </p>

                <a href="{{ route('user.hoteis.show', $hotel->id) }}"
                   class="inline-block mt-4 bg-primaria text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primaria-dark transition">
                    Ver Hotel
                </a>
            </div>

        </div>

    @empty
        <p>Nenhum hotel disponível.</p>
    @endforelse

</div>