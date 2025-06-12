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
        /* Reset básico */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: space-between;
            padding: 0 1rem;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #808080;
        }

        .navbar-nav .nav-link {
            color: #e0e0e0;
            margin-left: 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #A9A9A9;
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            color: #e0e0e0;
            text-align: center;
        }

        .form-label {
            font-weight: 500;
            color: #e0e0e0;
        }

        .form-control {
            background-color: #333;
            border: 1px solid #555;
            color: #e0e0e0;
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #808080;
            box-shadow: 0 0 0 0.25rem rgba(128, 128, 128, 0.25);
        }

        #map {
            height: 320px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid #555;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        /* Botões estilizados */
        .btn-primary {
            background-color: #808080;
            border-color: #808080;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #A9A9A9;
            border-color: #A9A9A9;
        }

        .btn-secondary {
            background-color: #333;
            color: #e0e0e0;
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            margin-right: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-secondary:hover {
            background-color: #444;
        }

        form {
            background-color: #1e1e1e;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

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

        @media (max-width: 480px) {
            form {
                padding: 1.5rem;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

<header class="py-3" style="background-color: #1e1e1e;">
    <nav class="container d-flex justify-content-between align-items-center">
        <a class="brand text-decoration-none" href="#">Uber Clone</a>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="HistoricoCorrida.php">Minhas Corridas</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
            <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
        </ul>
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

        <a href="Dashboard.php" class="btn btn-secondary mt-4">Voltar</a>
        <button type="submit" name="acao" value="criar" class="btn btn-primary mt-4">Solicitar Corrida</button>
    </form>
</main>

<footer>
    <div class="container">
        <div class="social-icons">
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
        <div class="contact-info">
            <p>Contato: suporte@uberclone.com</p>
        </div>
        <div class="footer-copy">
            &copy; 2025 Uber Clone - Todos os direitos reservados.
        </div>
    </div>
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var map = L.map('map', { zoomControl: false }).setView([-23.55052, -46.633308], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.control.zoom({ position: 'topright' }).addTo(map);

    function criarMarcador(latlng, texto) {
        return L.marker(latlng).addTo(map).bindPopup(texto);
    }

    var origemLatLng = [-23.55052, -46.633308];
    var destinoLatLng = [-23.5587, -46.6253];

    var marcadorOrigem = criarMarcador(origemLatLng, "Origem");
    var marcadorDestino = criarMarcador(destinoLatLng, "Destino");

    var group = new L.featureGroup([marcadorOrigem, marcadorDestino]);
    map.fitBounds(group.getBounds().pad(0.2));

    var linha = L.polyline([origemLatLng, destinoLatLng], {
        color: '#808080',
        weight: 4,
        opacity: 0.7,
        dashArray: '10, 10'
    }).addTo(map);
</script>

</body>
</html>
