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
</body>
</html>