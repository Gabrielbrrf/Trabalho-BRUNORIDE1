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
</body>
</html>