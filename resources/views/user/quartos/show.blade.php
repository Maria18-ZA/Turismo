<h1>{{ $quarto->nome }}</h1>

<p>{{ $quarto->descricao }}</p>

<p>Preço: {{ $quarto->preco }}</p>

<form method="POST" action="{{ route('reservas.store') }}">
    @csrf

    <input type="hidden" name="quarto_id" value="{{ $quarto->id }}">

    <input type="date" name="data_entrada">
    <input type="date" name="data_saida">

    <button>Reservar</button>
</form>