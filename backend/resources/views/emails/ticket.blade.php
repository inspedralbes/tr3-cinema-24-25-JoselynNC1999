<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Entrada de Cinema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        .ticket {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background: #fdfdfd;
            margin-bottom: 15px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #e9ecef;
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .qr-code {
            text-align: center;
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .qr-code img {
            width: 120px;
            height: 120px;
        }
        p strong {
            color: #dc3545;
        }
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
