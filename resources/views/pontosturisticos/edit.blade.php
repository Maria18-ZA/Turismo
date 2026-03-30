@extends('layouts.app')

@section('content')
    <h1>Editar Ponto Turístico</h1>

    <a href="{{ route('pontosturisticos.index') }}">← Voltar à lista</a>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pontosturisticos.update', $pontoTuristico) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $pontoTuristico->nome) }}">
        </div>

        <div>
            <label for="localizacao">Localização</label>
            <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao', $pontoTuristico->localizacao) }}">
        </div>

        <div>
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao">{{ old('descricao', $pontoTuristico->descricao) }}</textarea>
        </div>

        <div>
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <option value="">-- Seleciona --</option>
                <option value="Praia" {{ old('categoria', $pontoTuristico->categoria) == 'Praia' ? 'selected' : '' }}>Praia</option>
                <option value="Museu" {{ old('categoria', $pontoTuristico->categoria) == 'Museu' ? 'selected' : '' }}>Museu</option>
                <option value="Monumento" {{ old('categoria', $pontoTuristico->categoria) == 'Monumento' ? 'selected' : '' }}>Monumento</option>
                <option value="Parque" {{ old('categoria', $pontoTuristico->categoria) == 'Parque' ? 'selected' : '' }}>Parque</option>
                <option value="Outro" {{ old('categoria', $pontoTuristico->categoria) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

        <div>
            <label for="contato">Contato (opcional)</label>
            <input type="text" name="contato" id="contato" value="{{ old('contato', $pontoTuristico->contato) }}">
        </div>

        <button type="submit">Atualizar</button>
    </form>
@endsection