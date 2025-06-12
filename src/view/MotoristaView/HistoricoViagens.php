<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../config/conexao.php';

$motorista_id = $_SESSION['usuario']['id'];
$sql = "SELECT * FROM corridas WHERE motorista_id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $motorista_id);
$stmt->execute();
$result = $stmt->get_result();
$viagens = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Viagens</title>
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

        main {
            flex: 1;
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="HistoricoViagens.php">Histórico de Viagens</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <h2>Histórico de Viagens</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Status</th>
                <th>Passageiro</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($viagens): ?>
                <?php foreach ($viagens as $viagem): ?>
                    <tr>
                        <td><?= htmlspecialchars($viagem['id']) ?></td>
                        <td><?= htmlspecialchars($viagem['origem']) ?></td>
                        <td><?= htmlspecialchars($viagem['destino']) ?></td>
                        <td><?= htmlspecialchars($viagem['status']) ?></td>
                        <td><?= htmlspecialchars($viagem['passageiro_id']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhuma viagem encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="Dashboard.php" class="btn btn-secondary">Voltar ao Dashboard</a>
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
