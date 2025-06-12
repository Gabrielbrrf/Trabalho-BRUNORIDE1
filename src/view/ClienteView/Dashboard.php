<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
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
        .content-wrapper {
            flex: 1;
            display: flex;
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            gap: 20px;
            padding: 0 15px;
        }
        aside {
            flex: 0 0 220px;
            min-width: 180px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #333;
            position: relative;
            overflow: hidden;
            min-height: 180px;
            text-align: center;
        }
        aside img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            filter: brightness(0.9);
        }
        main.container {
            flex: 1;
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            text-align: center;
            max-width: none;
            position: relative;
        }
        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: #000;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #555;
        }
        .d-flex.gap-3.mb-3 {
            justify-content: center;
        }
        .btn-primary {
            background-color: #000;
            border-color: #000;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s;
            flex: 1;
            max-width: 180px;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
        .btn-info {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            color: #fff;
            background-color: #0dcaf0;
            border: none;
            transition: background-color 0.3s;
            flex: 1;
            max-width: 180px;
        }
        .btn-info:hover {
            background-color: #31d2f2;
        }
        .btn-danger {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            background-color: #dc3545;
            border: none;
            color: #fff;
            transition: background-color 0.3s;
            flex: 1;
            max-width: 180px;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
        }
        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: auto;
        }

        /* Banner animado */
        #ad-banner {
            margin: 30px auto 0 auto;
            max-width: 600px;
            height: 180px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            cursor: pointer;
            user-select: none;
        }

        #ad-banner img.bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.25;
            filter: brightness(0.7);
            pointer-events: none;
            transition: opacity 0.3s ease;
            border-radius: 15px;
        }

        #ad-banner .text {
            position: relative;
            z-index: 2;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            padding: 20px;
            line-height: 1.3;
            text-shadow:
                2px 2px 6px rgba(0,0,0,0.7),
                0 0 10px rgba(0,0,0,0.4);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards;
            animation-delay: 0.5s;
        }

        #ad-banner:hover img.bg-image {
            opacity: 0.4;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsividade */
        @media (max-width: 991px) {
            .content-wrapper {
                flex-direction: column;
                width: 95%;
                margin: 20px auto;
            }
            aside {
                flex: none;
                width: 100%;
                min-width: auto;
                margin-bottom: 20px;
            }
            main.container {
                width: 100%;
                padding: 30px 20px;
            }
            #ad-banner {
                max-width: 100%;
                height: 140px;
            }
            #ad-banner .text {
                font-size: 1.2rem;
                padding: 15px;
            }
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
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="content-wrapper">
    <aside>
        <h4>Seu espaço de conforto</h4>
        <p>Solicite suas corridas com facilidade e segurança.</p>
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Carro na estrada" />
    </aside>

    <main class="container">
        <h2>Bem-vindo, <?= htmlspecialchars($usuario['email']) ?>!</h2>
        <p>Esta é a área do cliente.</p>
        <div class="d-flex gap-3 mb-3">
            <a href="CadastroCorrida.php" class="btn btn-primary">Pedir Corrida</a>
            <a href="HistoricoViagens.php" class="btn btn-info">Histórico de Viagens</a>
            <a href="../../controller/logout.php" class="btn btn-danger">Sair</a>
        </div>

        <!-- Banner animado JS -->
        <div id="ad-banner" title="Propaganda Bolsonaro">
            <img class="bg-image" src="https://conteudo.imguol.com.br/c/noticias/68/2025/06/10/o-ex-presidente-jair-bolsonaro-durante-sessao-de-interrogatorio-no-stf-1749567761281_v2_360x480.jpg.webp" alt="Bolsonaro" />
            <div class="text">"Transporte confiável com segurança e agilidade.",
        "Serviço que conecta você com o Brasil.",
        "Bolsonaro apoiando a mobilidade do país!"</div>
        </div>
    </main>

    <aside>
        <h4>Dicas rápidas</h4>
        <p>Use o app para rastrear sua corrida em tempo real e garantir a melhor experiência.</p>
        <img src="https://images.unsplash.com/photo-1518609878373-06d740f60d8b?auto=format&fit=crop&w=400&q=80" alt="Mapa e smartphone" />
    </aside>
</div>

<footer>
    &copy; 2025 Uber Clone - Todos os direitos reservados.
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var map = L.map('map').setView([-23.55052, -46.633308], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Texto que vai aparecer animado no banner
    const bannerText = [
        "Transporte confiável com segurança e agilidade.",
        "Serviço que conecta você com o Brasil.",
        "Bolsonaro apoiando a mobilidade do país!"
    ];

    const textContainer = document.querySelector('#ad-banner .text');
    let index = 0;

    function animateText() {
        textContainer.style.opacity = 0;
        setTimeout(() => {
            textContainer.textContent = bannerText[index];
            textContainer.style.opacity = 1;
            index = (index + 1) % bannerText.length;
        }, 500);
    }

    animateText(); // primeira exibição
    setInterval(animateText, 4000); // troca a cada 4 segundos
</script>

</body>
</html>
