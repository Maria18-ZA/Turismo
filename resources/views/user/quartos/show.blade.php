<h1>{{ $quartos->nome }}</h1>

<p>{{ $quartos->descricao }}</p>

<p>Preço: {{ $quartos->preco }}</p>


<form method="POST" action="{{ route('reservas.store') }}">
    @csrf

    <input type="hidden" name="quarto_id" value="{{ $quartos->id }}">

    <label for="nome_user">Nome</label>
    <input type="text" name="nome_user">

    <input type="date" name="data_entrada">
    <input type="date" name="data_saida">

    <button>Reservar</button>
</form>