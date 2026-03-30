@extends('layouts.app')

@section('content')
    <h1>Editar Serviço</h1>

    <a href="{{ route('servicos.index') }}">← Voltar à lista</a>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('servicos.update', $servicos) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $servicos->nome) }}">
        </div>

        <div>
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao">{{ old('descricao', $servicos->descricao) }}</textarea>
        </div>

        <div>
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo">
                <option value="">-- Seleciona --</option>
                <option value="Guia Turístico" {{ old('tipo', $servicos->tipo) == 'Guia Turístico' ? 'selected' : '' }}>Guia Turístico</option>
                <option value="Transporte" {{ old('tipo', $servicos->tipo) == 'Transporte' ? 'selected' : '' }}>Transporte</option>
                <option value="Excursão" {{ old('tipo', $servicos->tipo) == 'Excursão' ? 'selected' : '' }}>Excursão</option>
                <option value="Outro" {{ old('tipo', $servicos->tipo) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

        <button type="submit">Atualizar</button>
    </form>
@endsection
```