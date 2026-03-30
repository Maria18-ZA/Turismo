@extends('layouts.app')
@section('content')
    <h1>Criar Hotel </h1>

    <a href="{{ route('hoteis.index') }}">← Voltar à lista</a>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('hoteis.store') }}" method="POST">
    @csrf

    <div>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}">
    </div>

    <div>
        <label for="localizacao">Localização</label>
        <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}">
    </div>

    <div>
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao">{{ old('descricao') }}</textarea>
    </div>

    <div>
        <label for="contato">Contato</label>
        <input type="text" name="contato" id="contato" value="{{ old('contato') }}">
    </div>

    <button type="submit">Criar</button>
</form> {{-- FECHAR FORM --}}

@endsection 
      