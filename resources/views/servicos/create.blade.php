@extends('layouts.app')

@section('content')
    <h1>Criar Serviço</h1>

    <a href="{{ route('servicos.index') }}">← Voltar à lista</a>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('servicos.store') }}" method="POST">
        @csrf

        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}">
        </div>

        <div>
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao">{{ old('descricao') }}</textarea>
        </div>

        <div>
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo">
                <option value="">-- Seleciona --</option>
                <option value="Guia Turístico" {{ old('tipo') == 'Guia Turístico' ? 'selected' : '' }}>Guia Turístico</option>
                <option value="Transporte" {{ old('tipo') == 'Transporte' ? 'selected' : '' }}>Transporte</option>
                <option value="Excursão" {{ old('tipo') == 'Excursão' ? 'selected' : '' }}>Excursão</option>
                <option value="Outro" {{ old('tipo') == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

          <div>
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" id="hotel_id">
                <option value="">-- Seleciona --</option>
                @foreach($hoteis as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->nome }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit">Criar</button>
    </form>
@endsection