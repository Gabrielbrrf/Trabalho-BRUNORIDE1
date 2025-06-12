<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Corrida Solicitada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

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
        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: auto;
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
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

<main class="container mt-5">
    <?php
    $origem = $_GET['origem'] ?? '';
    $destino = $_GET['destino'] ?? '';
    $id = $_GET['id'] ?? '';
    ?>

    <h2 class="text-success">✅ Corrida solicitada com sucesso!</h2>
    <p><strong>Origem:</strong> <?= htmlspecialchars($origem) ?></p>
    <p><strong>Destino:</strong> <?= htmlspecialchars($destino) ?></p>

    <div id="map"></div>

    <a href="Dashboard.php" class="btn btn-secondary mt-4 me-2">Voltar</a>
    <a href="CadastroCorrida.php" class="btn btn-primary mt-4">Solicitar Nova Corrida</a>
    <a href="EditarCorrida.php?id=<?= urlencode($id) ?>&origem=<?= urlencode($origem) ?>&destino=<?= urlencode($destino) ?>" class="btn btn-warning mt-4 ms-2">Editar Corrida</a>
    <?php if ($id): ?>
        <button class="btn btn-danger mt-4 ms-2" onclick="cancelarCorrida(<?= htmlspecialchars(json_encode($id)) ?>)">Cancelar Corrida</button>
    <?php endif; ?>
</main>

<footer>
    &copy; 2025 Uber Clone - Todos os direitos reservados.
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- Leaflet Routing Machine -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function cancelarCorrida(id) {
        if (confirm('Tem certeza que deseja cancelar esta corrida?')) {
            window.location.href = "../../controller/CorridaController.php?acao=excluir&id=" + encodeURIComponent(id);
        }
    }

    // Função para geocodificar texto para latlng usando Nominatim (OpenStreetMap)
    async function geocode(address) {
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;
        const response = await fetch(url);
        const data = await response.json();
        if (data && data.length > 0) {
            return [parseFloat(data[0].lat), parseFloat(data[0].lon)];
        } else {
            return null;
        }
    }

    (async () => {
        const origemStr = <?= json_encode($origem) ?>;
        const destinoStr = <?= json_encode($destino) ?>;

        const map = L.map('map').setView([-23.55052, -46.633308], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Geocodifica origem e destino
        const origemCoords = await geocode(origemStr);
        const destinoCoords = await geocode(destinoStr);

        if (origemCoords && destinoCoords) {
            L.Routing.control({
                waypoints: [
                    L.latLng(origemCoords[0], origemCoords[1]),
                    L.latLng(destinoCoords[0], destinoCoords[1])
                ],
                routeWhileDragging: false,
                draggableWaypoints: false,
                addWaypoints: false,
                showAlternatives: false
            }).addTo(map);
        } else {
            alert('Não foi possível localizar a origem ou destino no mapa Faz o L e engole o choro');
            // Apenas mostra o mapa padrão
            map.setView([-23.55052, -46.633308], 13);
        }
    })();
</script>
</body>
</html>
