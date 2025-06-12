<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}
require_once '../../controller/VeiculoController.php';

$motorista_id = $_SESSION['usuario']['id'];
$controller = new VeiculoController();
$veiculos = $controller->listarVeiculosPorMotorista($motorista_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meus Veículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Meus Veículos</h2>
    <a href="CadastroVeiculo.php" class="btn btn-success mb-3">Inserir Novo Veículo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($veiculos): ?>
                <?php foreach ($veiculos as $veiculo): ?>
                    <tr>
                        <td><?= htmlspecialchars($veiculo['id']) ?></td>
                        <td><?= htmlspecialchars($veiculo['modelo']) ?></td>
                        <td><?= htmlspecialchars($veiculo['placa']) ?></td>
                        <td>
                            <a href="EditarVeiculo.php?id=<?= $veiculo['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="ExcluirVeiculo.php?id=<?= $veiculo['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Nenhum veículo cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="Dashboard.php" class="btn btn-secondary">Voltar ao Dashboard</a>
</body>
</html>