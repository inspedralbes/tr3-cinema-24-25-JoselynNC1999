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
    .form-container, .sessions-container {
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
    .form-group input, .form-group select {
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

    .session-item {
        background: white;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .session-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }
    .hidden {
        display: none;
    }
</style>

<div class="container">
    <h1>🎬 Gestió de Sessions de Pel·lícules</h1>

    <!-- Formulario para agregar una sesión -->
    <div class="form-container">
        <h2>➕ Afegir Nova Sessió</h2>
        <form action="{{ route('sessions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Pel·lícula:</label>
                <select name="movie_id" required>
                    @foreach(App\Models\Movie::all() as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Data:</label>
                <input type="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- Llista de Sessions -->
    <div class="sessions-container">
        <h2>🎥 Llista de Sessions</h2>
        @if($sessions->count() > 0)
            <!-- Agrupar sesiones por fecha -->
            @php
                $groupedSessions = $sessions->groupBy('date');
            @endphp

            @foreach($groupedSessions as $date => $sessionsGroup)
                <div class="session-item">
                    <h3>📅 Data: {{ $date }}</h3>
                    @foreach($sessionsGroup as $session)
                        <div style="margin-left: 20px;">
                            <p>🎬 Pel·lícula: {{ $session->movie->title }}</p>
                            <p>⏰ Hora: {{ $session->time }}</p>

                            <div class="session-actions">
                                <!-- Botón Editar -->
                                <button onclick="toggleEditForm({{ $session->id }})" class="btn btn-warning">Editar</button>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar aquesta sessió?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>

                            <!-- Formulario de Edición -->
                            <div id="edit-form-{{ $session->id }}" class="hidden">
                                <h3>✏️ Editar Sessió</h3>
                                <form action="{{ route('sessions.update', $session->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Pel·lícula:</label>
                                        <select name="movie_id" required>
                                            @foreach(App\Models\Movie::all() as $movie)
                                                <option value="{{ $movie->id }}" {{ $movie->id == $session->movie_id ? 'selected' : '' }}>
                                                    {{ $movie->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Data:</label>
                                        <input type="date" name="date" value="{{ $session->date }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p class="text-center">⚠️ No hi ha sessions disponibles.</p>
        @endif
    </div>
</div>

<script>
    function toggleEditForm(id) {
        var form = document.getElementById('edit-form-' + id);
        form.classList.toggle('hidden');
    }
</script>

@endsection