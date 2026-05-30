@extends('layouts.app')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl text-center font-bold text-texto-escuro mb-6">Editar Reserva #{{ $reserva->id }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow border space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Check-in</label>
            <input type="date" name="checkin" value="{{ old('checkin', $reserva->checkin) }}" class="w-full border rounded-lg px-4 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Check-out</label>
            <input type="date" name="checkout" value="{{ old('checkout', $reserva->checkout) }}" class="w-full border rounded-lg px-4 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-texto-escuro mb-1">Status</label>
            <select name="status" class="w-full border rounded-lg px-4 py-2">
                <option value="pendente" {{ $reserva->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="confirmada" {{ $reserva->status == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ $reserva->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <div class="flex justify-between pt-4">
            <a href="{{ route('reservas.index') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg">Voltar</a>
            <button type="submit" class="bg-primaria text-white px-5 py-2 rounded-lg">Atualizar</button>
        </div>
    </form>
</div>
@endsection