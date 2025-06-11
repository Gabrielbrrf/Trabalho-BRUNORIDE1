<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Corrida Solicitada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        #map {
            height: 400px;
            margin-top: 20px;
        }
    </style>
</head>
<body class="container mt-5">
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

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine -->
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script>
        // Inicializa o mapa
        var map = L.map('map').setView([-23.55052, -46.633308], 13);

        // Camada base do OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Pega origem e destino do PHP
        var origem = "<?= $origem ?>";
        var destino = "<?= $destino ?>";

        // Adiciona rota no mapa
        L.Routing.control({
            waypoints: [
                L.Routing.waypoint(null, origem),
                L.Routing.waypoint(null, destino)
            ],
            routeWhileDragging: false,
            language: 'pt',
            show: false,
            addWaypoints: false
        }).addTo(map);

        function cancelarCorrida(id) {
            if (confirm('Tem certeza que deseja cancelar esta corrida?')) {
                // Redireciona para o controller para excluir a corrida
                window.location.href = "../../controller/CorridaController.php?acao=excluir&id=" + encodeURIComponent(id);
            }
        }
    </script>
</body>
</html>
