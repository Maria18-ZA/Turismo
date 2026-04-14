<h1>{{ $hotel->nome }}</h1>

<p>{{ $hotel->descricao }}</p>

<h2>Quartos</h2>

@foreach($hotel->quartos as $quarto)
    <div>
        <h3>{{ $quarto->nome }}</h3>

        <a href="{{ route('quartos.show', $quarto->id) }}">
            Ver quarto
        </a>
    </div>
@endforeach