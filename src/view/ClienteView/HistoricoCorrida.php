<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../controller/CorridaController.php';

$passageiro_id = $_SESSION['usuario']['id'];
$controller = new CorridaController();
$viagens = $controller->listarCorridasPorPassageiro($passageiro_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Viagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1c1c1e;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
    </style>
</head>
<body class="container mt-5">
    <h2>Histórico de Viagens</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Status</th>
                <th>Motorista</th>
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
                        <td><?= htmlspecialchars($viagem['motorista_id']) ?></td>
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
     <!-- ✅ Rodapé -->
    <footer>
        &copy; 2025 Uber Clone - Todos os direitos reservados.
    </footer>
</body>
</html>