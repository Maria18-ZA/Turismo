<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Reserva</title>
</head>
<body style="font-family: Arial; background: #f4f4f4; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: white; border-radius: 10px; padding: 30px;">
        
        <h1 style="color: #0f172a;">Nova Reserva Recebida</h1>
        
        <p><strong>Cliente:</strong> {{ $reserva->nome_user }}</p>
        <p><strong>Email:</strong> {{ $reserva->email }}</p>
        <p><strong>Telefone:</strong> {{ $reserva->contato }}</p>
        <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reserva->checkin)->format('d/m/Y') }}</p>
        <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reserva->checkout)->format('d/m/Y') }}</p>
        
        @if(isset($hotel) && $hotel)
            <div style="background: #e8f5e9; padding: 15px; margin: 15px 0;">
                <h3>Hotel: {{ $hotel->nome }}</h3>
                <p>Endereço: {{ $hotel->localizacao }}</p>
                
                @if(isset($googleMapsLink) && $googleMapsLink)
                    <a href="{{ $googleMapsLink }}" target="_blank"> Ver no Google Maps</a>
                @endif
            </div>
        @endif
        
        @php $quarto = $reserva->quartos->first(); @endphp
        @if($quarto)
            <p><strong>Número do quarto:</strong> {{ $quarto->numero }}</p>
            <p><strong>Tipo:</strong> {{ $quarto->tipo }}</p>
        @endif
        
        <hr>
        <p>Esta reserva foi enviada automaticamente pelo sistema.</p>
        
    </div>
</body>
</html>