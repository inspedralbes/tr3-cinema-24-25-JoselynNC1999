<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panell d'Administrador - Cinépolis Pedralbes</title>
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .dashboard-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-metrics {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .metric-box {
            background-color: #f4f4f4;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
        }

        .metric-value {
            font-size: 24px;
            font-weight: bold;
            color: #0A4B96;
            margin-bottom: 5px;
        }

        .metric-label {
            font-size: 14px;
            color: #666;
        }

        .chart-placeholder {
            background-color: #e0e0e0;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
        }

        .button-primary {
            background-color: #0A4B96;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">CINÉPOLIS PEDRALBES</div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="{{ route('sessions.index') }}">Gestió de Sessions</a></li>
            <li><a href="#">Pel·lícules</a></li>
            <li><a href="#">Entrades</a></li>
            <li><a href="#">Usuaris</a></li>
            <li><a href="#">Configuració</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <div class="header-title">Dashboard</div>
            <button class="button-primary">Informe Setmanal</button>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">Resum de Vendes</div>
                    <button class="button-primary">Detalls</button>
                </div>
                <div class="card-metrics">
                    <div class="metric-box">
                        <div class="metric-value">3.245€</div>
                        <div class="metric-label">Ingressos Totals</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">642</div>
                        <div class="metric-label">Entrades Venudes</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">18</div>
                        <div class="metric-label">Sessions Avui</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">35%</div>
                        <div class="metric-label">Ocupació Mitja</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">Gràfic d'Ingressos</div>
                    <button class="button-primary">Exportar</button>
                </div>
                <div class="chart-placeholder">
                    Gràfic d'Ingressos
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">Pel·lícules Més Populars</div>
                    <button class="button-primary">Veure Totes</button>
                </div>
                <div class="card-metrics">
                    <div class="metric-box">
                        <div class="metric-value">Interstellar</div>
                        <div class="metric-label">305 Entrades</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">Dune</div>
                        <div class="metric-label">276 Entrades</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">Avatar</div>
                        <div class="metric-label">248 Entrades</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">Oppenheimer</div>
                        <div class="metric-label">221 Entrades</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-title">Estat de Sessions</div>
                    <button class="button-primary">Gestionar</button>
                </div>
                <div class="card-metrics">
                    <div class="metric-box">
                        <div class="metric-value">42</div>
                        <div class="metric-label">Sessions Programades</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">35</div>
                        <div class="metric-label">Sessions Avui</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">7</div>
                        <div class="metric-label">Sessions Cancel·lades</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-value">98%</div>
                        <div class="metric-label">Taxa d'Execució</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>