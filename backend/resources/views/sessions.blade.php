<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió de Sessions - Cinema Pedralbes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #0A4B96;
            color: white;
            padding: 20px;
        }

        .sidebar-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.2);
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f4f4f4;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
        }

        .button-primary {
            background-color: #0A4B96;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #4CAF50;
            color: white;
        }

        .sessions-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .sessions-table {
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .sessions-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .sessions-table th, 
        .sessions-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
        }

        .sessions-table thead {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-delete {
            background-color: #F44336;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-view {
            background-color: #0A4B96;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .special-session {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            background-color: #FF9800;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">CINEMA PEDRALBES</div>
        <ul class="sidebar-menu">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#" class="active">Gestió de Sessions</a></li>
            <li><a href="#">Pel·lícules</a></li>
            <li><a href="#">Entrades</a></li>
            <li><a href="#">Usuaris</a></li>
            <li><a href="#">Configuració</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <div class="header-title">Gestió de Sessions</div>
        </div>

        <!-- Success Message -->
        <div class="alert alert-success" style="display: none;">
            {{ session('success') }}
        </div>

        <!-- New Session Form -->
        <div class="sessions-form">
            <form action="{{ route('sessions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="movie_id" class="form-label">Pel·lícula</label>
                    <select name="movie_id" id="movie_id" class="form-control" required>
                        @foreach($movies as $movie)
                            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date" class="form-label">Data</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="is_special" class="form-label">
                        <input type="checkbox" name="is_special" id="is_special" value="1">
                        Sessió Especial
                    </label>
                </div>
                <button type="submit" class="button-primary">Crear Sessió</button>
            </form>
        </div>

        <!-- Sessions Table -->
        <div class="sessions-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pel·lícula</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Especial</th>
                        <th>Accions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->movie->title }}</td>
                            <td>{{ $session->date }}</td>
                            <td>{{ $session->time }}</td>
                            <td>
                                @if($session->is_special)
                                    <span class="special-session">Sí</span>
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <form action="{{ route('sessions.destroy', $session->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Segur que vols eliminar?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>