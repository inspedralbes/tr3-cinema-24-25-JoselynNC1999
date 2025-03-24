<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Entrada de Cinema</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { padding: 20px; }
        .ticket { border: 1px solid #000; padding: 10px; }
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
    </div>
</body>
</html>
