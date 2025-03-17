@extends('layouts.app')

@section('content')
<style>
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    h1, h2 {
        text-align: center;
    }
    .form-container, .movies-container {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: bold;
        display: block;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn {
        display: inline-block;
        padding: 10px 15px;
        text-align: center;
        border: none;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-primary { background: blue; }
    .btn-success { background: green; }
    .btn-warning { background: orange; }
    .btn-danger { background: red; }
    .btn:hover { opacity: 0.8; }

    .movie-item {
        background: white;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .movie-item img {
        width: 100px;
        height: auto;
        display: block;
        margin-bottom: 10px;
    }
    .movie-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }
</style>

<div class="container">
    <h1>🎬 Gestió de Pel·lícules</h1>

    <!-- Formulario para agregar una película -->
    <div class="form-container">
        <h2>➕ Afegir Nova Pel·lícula</h2>
        <form action="{{ route('movies.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Títol:</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Descripció:</label>
                <textarea name="description" required></textarea>
            </div>
            <div class="form-group">
                <label>URL del Pòster:</label>
                <input type="url" name="poster_url" required>
            </div>
            <div class="form-group">
                <label>Duració (minuts):</label>
                <input type="number" name="duration" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- Llista de Pel·lícules -->
    <div class="movies-container">
        <h2>🎥 Llista de Pel·lícules</h2>
        @if($movies->count() > 0)
            @foreach($movies as $movie)
                <div class="movie-item">
                    <img src="{{ $movie->poster_url }}" alt="Pòster de {{ $movie->title }}">
                    <h3>{{ $movie->title }}</h3>
                    <p>{{ $movie->description }}</p>
                    <p>⏳ Duració: {{ $movie->duration }} min</p>

                    <div class="movie-actions">
                        <!-- Botón Mostrar -->
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-success">Veure</a>
                        
                        <!-- Botón Editar -->
                        <button onclick="document.getElementById('edit-form-{{ $movie->id }}').style.display='block'" class="btn btn-warning">Editar</button>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar aquesta pel·lícula?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>

                    <!-- Formulario de Edición -->
                    <div id="edit-form-{{ $movie->id }}" style="display: none; margin-top: 10px; background: #eee; padding: 10px; border-radius: 5px;">
                        <h3>✏️ Editar Pel·lícula</h3>
                        <form action="{{ route('movies.update', $movie->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="title" value="{{ $movie->title }}">
                            <input type="text" name="description" value="{{ $movie->description }}">
                            <input type="url" name="poster_url" value="{{ $movie->poster_url }}">
                            <input type="number" name="duration" value="{{ $movie->duration }}">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">⚠️ No hi ha pel·lícules disponibles.</p>
        @endif
    </div>
</div>
@endsection
