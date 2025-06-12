<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Mapa com Leaflet - Uber Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1c1c1e;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
        }

        header .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-weight: 500;
            margin-left: 15px;
        }

        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            color: #000;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #d1d1d6;
            padding: 10px 15px;
            font-size: 1rem;
        }

        #map {
            height: 320px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #000;
            border-color: #000;
            border-radius: 25px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }

        .btn-secondary {
            background-color: #e5e5ea;
            color: #000;
            border: none;
            border-radius: 25px;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-secondary:hover {
            background-color: #d1d1d6;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        }

        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: auto;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Uber Clone</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Minhas Corridas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5 mb-5 flex-grow-1">
    <h2>Criar Corrida</h2>
    <form method="post" action="../../controller/CorridaController.php">
        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" class="form-control" name="origem" id="origem" required>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" class="form-control" name="destino" id="destino" required>
        </div>
        <div id="map" class="mb-3"></div>

        <a href="Dashboard.php" class="btn btn-secondary mt-4 me-2">Voltar</a>
        <button type="submit" name="acao" value="criar" class="btn btn-primary mt-4">Solicitar Corrida</button>
    </form>
</main>

<footer>
    &copy; 2025 Uber Clone - Todos os direitos reservados.
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Inicializa o mapa com vista padrão
    var map = L.map('map', {
        zoomControl: false  // Desabilita controle padrão para reposicionar
    }).setView([-23.55052, -46.633308], 13);

    // Adiciona tile layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Adiciona controle de zoom no canto superior direito
    L.control.zoom({ position: 'topright' }).addTo(map);

    // Função para criar marcador e popup
    function criarMarcador(latlng, texto) {
        return L.marker(latlng).addTo(map).bindPopup(texto);
    }

    // Posições exemplo para origem e destino
    var origemLatLng = [-23.55052, -46.633308];    // São Paulo centro
    var destinoLatLng = [-23.5587, -46.6253];      // Próximo ponto

    // Marcadores
    var marcadorOrigem = criarMarcador(origemLatLng, "Origem");
    var marcadorDestino = criarMarcador(destinoLatLng, "Destino");

    // Ajusta o mapa para mostrar os dois marcadores
    var group = new L.featureGroup([marcadorOrigem, marcadorDestino]);
    map.fitBounds(group.getBounds().pad(0.2));

    // Linha entre origem e destino
    var linha = L.polyline([origemLatLng, destinoLatLng], {
        color: '#000',
        weight: 4,
        opacity: 0.7,
        dashArray: '10, 10'
    }).addTo(map);

</script>

</body>
</html>
