<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Corrida Solicitada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        body {
            background-color: #121212;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #e0e0e0;
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
            color: #90ee90;
            text-align: center;
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid #444;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
            margin-top: 1rem;
        }

        /* Rodapé */
        footer {
            background-color: #2a2a2a;
            color: #ccc;
            text-align: center;
            padding: 2rem 0;
            width: 100%;
        }

        footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        footer .contact-info p,
        footer .footer-copy {
            margin: 0.5rem 0;
        }

        footer .footer-link {
            color: #808080;
            text-decoration: none;
        }

        footer .footer-link:hover {
            color: #A9A9A9;
            text-decoration: underline;
        }

        footer .social-icons {
            margin: 1rem 0;
        }

        footer .social-icons a {
            margin: 0 0.5rem;
        }

        footer .social-icons img {
            width: 32px;
            height: 32px;
            filter: invert(80%) sepia(20%) hue-rotate(30deg);
            transition: filter 0.3s;
        }

        footer .social-icons img:hover {
            filter: invert(50%) sepia(90%) hue-rotate(10deg) brightness(1.2);
        }

        footer .footer-copy {
            font-size: 0.875rem;
            color: #777;
        }

        /* Botões com Bootstrap padrão */
        .btn-secondary {
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .btn-secondary:hover {
            background-color: #5e5e5e;
            color: #e0e0e0;
        }

        .btn-primary {
            background-color: #008000;
            border: none;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            color: #fff;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #006600;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            color: #000;
            transition: background-color 0.3s;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            color: #fff;
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #b02a37;
        }

        @media (max-width: 480px) {
            .btn-secondary,
            .btn-primary,
            .btn-warning,
            .btn-danger {
                width: 100%;
                margin-bottom: 0.75rem;
            }
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1e1e1e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BlackDrive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="HistoricoCorrida.php">Minhas Corridas</a></li>
                    <a class="nav-link" href="/Trabalho-BRUNORIDE1/src/view/ClienteView/PerfilPassageiro.php?email=<?= urlencode($_SESSION['usuario']['email']) ?>">Perfil</a>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5 mb-5">
    <?php
    $origem = $_GET['origem'] ?? '';
    $destino = $_GET['destino'] ?? '';
    $id = $_GET['id'] ?? '';
    ?>

    <h2 class="text-success">✅ Corrida solicitada com sucesso!</h2>
    <p><strong>Origem:</strong> <?= htmlspecialchars($origem) ?></p>
    <p><strong>Destino:</strong> <?= htmlspecialchars($destino) ?></p>

    <div id="map"></div>

    <div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
        <a href="Dashboard.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
        <a href="CadastroCorrida.php" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nova Corrida
        </a>
        <a href="EditarCorrida.php?id=<?= urlencode($id) ?>&origem=<?= urlencode($origem) ?>&destino=<?= urlencode($destino) ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
        <?php if ($id): ?>
            <button class="btn btn-danger" onclick="cancelarCorrida(<?= htmlspecialchars(json_encode($id)) ?>)">
                <i class="fas fa-times"></i> Cancelar
            </button>
        <?php endif; ?>
    </div>
</main>

<footer>
    <div class="container">
        <div class="contact-info">
            <p>📧 <a href="mailto:blackdrive@corridas" class="footer-link">blackdrive@corridas</a></p>
            <p>📍 Av. Brasil, São Paulo-SP, Brasil</p>
        </div>
        <div class="social-icons">
            <a href="#" aria-label="Baixar no Google Play">
                <img src="../../style/icons/google-play.svg" alt="Google Play">
            </a>
            <a href="https://instagram.com/BlackDrive" target="_blank" aria-label="Instagram">
                <img src="../../style/icons/instagram.svg" alt="Instagram">
            </a>
            <a href="https://x.com/BlackDrive" target="_blank" aria-label="X">
                <img src="../../style/icons/x.svg" alt="X">
            </a>
        </div>
        <p class="footer-copy">&copy; 2025 BlackDrive. Todos os direitos reservados.</p>
    </div>
</footer>

<!-- JS: Leaflet & Routing -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<!-- JS: Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function cancelarCorrida(id) {
        if (confirm('Tem certeza que deseja cancelar esta corrida?')) {
            window.location.href = "Dashboard.php";
        }
    }

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
                showAlternatives: false,
                lineOptions: {
                    styles: [{color: '#008000', opacity: 0.7, weight: 5}]
                },
                createMarker: function(i, wp) {
                    return L.marker(wp.latLng, {
                        icon: L.icon({
                            iconUrl: i === 0 ? 'https://cdn-icons-png.flaticon.com/512/684/684908.png' : 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        })
                    }).bindPopup(i === 0 ? "Origem" : "Destino");
                }
            }).addTo(map);
        } else {
            alert('Não foi possível localizar a origem ou destino no mapa.');
            map.setView([-23.55052, -46.633308], 13);
        }
    })();
</script>
</body>
</html>
