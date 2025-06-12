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
            background-color: #f4f4f4;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            color: #fff !important;
            margin-left: 15px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: #000;
        }

        .dashboard-buttons a {
            border-radius: 25px;
            padding: 12px 24px;
            font-weight: 500;
            font-size: 1rem;
        }

        .dashboard-buttons .btn-info {
            color: #fff;
        }

        .illustration {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 30px 0;
        }

        footer p,
        footer small {
            margin: 0;
        }

        footer .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 1.25rem;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        footer .social-icons a:hover {
            color: #0d6efd;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🚗 Uber Clone</a>
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

<main class="dashboard-container">
    <h2>Olá, <?= htmlspecialchars($usuario['email']) ?>!</h2>
    <p>Bem-vindo à sua área de motorista. Aqui você pode gerenciar seus veículos e visualizar seu histórico de viagens.</p>

    <div class="dashboard-buttons d-flex flex-wrap gap-3 mt-4">
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

    <img src="https://cdn.pixabay.com/photo/2016/11/21/12/54/car-1845650_1280.jpg" alt="Imagem ilustrativa motorista" class="illustration mt-4">
</main>

<footer class="footer mt-auto text-white py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-3 mb-md-0 text-center text-md-start">
            <p class="mb-0">&copy; 2025 Uber Clone — Todos os direitos reservados.</p>
            <small class="text-muted">Construído com ❤️ para facilitar suas viagens.</small>
        </div>
        <div class="social-icons text-center text-md-end">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
    </div>
</footer>

</body>
</html>
