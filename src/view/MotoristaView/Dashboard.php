<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard do Motorista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* fundo preto suave */
            color: #e0e0e0; /* texto claro */
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .nav-link {
            color: #eee !important;
            margin-left: 15px;
        }

        .nav-link:hover {
            text-decoration: underline;
            color: #0dcaf0 !important; /* destaque ao passar mouse */
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 30px auto;
            background-color: #1f1f1f; /* fundo escuro do container */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
            flex-grow: 1;
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        p {
            color: #ccc;
            font-size: 1.1rem;
        }

        .dashboard-buttons a {
            border-radius: 25px;
            padding: 12px 24px;
            font-weight: 500;
            font-size: 1rem;
            flex-grow: 1;
            max-width: 220px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .dashboard-buttons .btn-primary {
            background-color: #198754;
            color: #fff;
            border: none;
        }
        .dashboard-buttons .btn-primary:hover {
            background-color: #157347;
            color: #fff;
        }

        .dashboard-buttons .btn-info {
            background-color: #0dcaf0;
            color: #000;
            border: none;
        }
        .dashboard-buttons .btn-info:hover {
            background-color: #31d2f2;
            color: #000;
        }

        .dashboard-buttons .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .dashboard-buttons .btn-danger:hover {
            background-color: #bb2d3b;
            color: #fff;
        }

        .illustration {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.6);
        }

        /* Rodapé */
        footer {
            background-color: #2a2a2a;
            color: #ccc;
            text-align: center;
            padding: 2rem 0;
            width: 100%;
            margin-top: auto;
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
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🚗 BlackDrive</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="HistoricoViagens.php">Minhas Corridas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Trabalho-BRUNORIDE1/src/view/MotoristaView/PerfilMotorista.php?email=<?= urlencode($_SESSION['usuario']['email']) ?>">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="dashboard-container">
    <h2>Olá, <?= htmlspecialchars($usuario['email']) ?>!</h2>
    <p>Bem-vindo à sua área de motorista. Aqui você pode gerenciar seus veículos e visualizar seu histórico de viagens.</p>

    <div class="dashboard-buttons d-flex flex-wrap gap-3 mt-4 justify-content-center">
        <a href="ListarVeiculos.php" class="btn btn-primary">
            <i class="bi bi-truck"></i> Meus Veículos
        </a>
        <a href="HistoricoViagens.php" class="btn btn-info">
            <i class="bi bi-clock-history"></i> Histórico de Viagens
        </a>
        <a href="../../controller/logout.php" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Sair
        </a>
    </div>

    <img src="../../style/icons/Capy.jpg" alt="Imagem ilustrativa motorista" class="illustration mt-4">
    
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

</body>
</html>
