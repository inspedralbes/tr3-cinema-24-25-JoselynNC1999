<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Entrada de Cinema</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { padding: 20px; }
        .ticket { border: 1px solid #000; padding: 10px; }
        .qr-code img { width: 150px; height: 150px; } /* Ajusta el tamaño del QR si es necesario */
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirmació de la reserva</h2>
        <p>Pelicula: <strong>{{ $movie_title }}</strong></p>
        <p>Data: <strong>{{ $date }}</strong></p>
        <p>Hora: <strong>{{ $time }}</strong></p>
        <p>Sala: <strong>{{ $room }}</strong></p>
        
        <h3>Butaques:</h3>
        <ul>
            @foreach ($seats as $seat)
                <li>{{ $seat['row'] }}{{ $seat['number'] }} ({{ $seat['type'] }}) - {{ $seat['price'] }}€</li>
            @endforeach
        </ul>

        <p><strong>Total: {{ $total_price }}€</strong></p>

        <h3>Codi QR per a cada butaca:</h3>
        @foreach ($seats as $seat)
            <div class="qr-code">
                <p>Asiento: {{ $seat['row'] }}{{ $seat['number'] }}</p>
                <img src="{{ $seat['qrCode'] }}" alt="Ticket QR Code">
                <p>Ticket ID: {{ $seat['ticketId'] }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
