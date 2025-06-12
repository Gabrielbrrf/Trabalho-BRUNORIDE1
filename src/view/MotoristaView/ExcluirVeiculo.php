<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../model/Veiculo.php';

$id = $_GET['id'] ?? null;
$veiculo = null;

if ($id) {
    $dados = Veiculo::listarPorMotorista($_SESSION['usuario']['id']);
    foreach ($dados as $v) {
        if ($v['id'] == $id) {
            $veiculo = $v;
            break;
        }
    }
}

if (!$veiculo) {
    echo "<script>alert('Veículo não encontrado.'); window.location.href='ListarVeiculos.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Veículo</title>
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

        .card {
            max-width: 600px;
            width: 100%;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        h2 {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert {
            font-size: 1.1rem;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
        }

        .btn + .btn {
            margin-left: 10px;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 30px 0;
            margin-top: auto;
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
                    <li class="nav-item"><a class="nav-link" href="#">Minhas Corridas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="card">
        <h2 class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Excluir Veículo</h2>
        <div class="alert alert-warning">
            Tem certeza que deseja excluir o veículo <strong><?= htmlspecialchars($veiculo['modelo']) ?></strong><br>
            (Placa: <?= htmlspecialchars($veiculo['placa']) ?>)?
        </div>
        <form action="../../controller/VeiculoController.php" method="post" class="text-center mt-4">
            <input type="hidden" name="acao" value="excluir">
            <input type="hidden" name="id" value="<?= htmlspecialchars($veiculo['id']) ?>">
            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill me-1"></i>Sim, excluir</button>
            <a href="ListarVeiculos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>

<footer class="footer text-white py-4">
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
