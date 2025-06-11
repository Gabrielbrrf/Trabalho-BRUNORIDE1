<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mapa com Leaflet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
</head>
<body class="container mt-5">
    <h2 class="mb-4">Criar Corrida</h2>

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
        <br>
        <br>
        <button type="submit" name="acao" value="criar" class="btn btn-primary">Solicitar Corrida</button>

    </form>

    <!-- ✅ Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- ✅ Bootstrap Bundle (JS + Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var map = L.map('map').setView([-23.55052, -46.633308], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    </script>
</body>
</html>
