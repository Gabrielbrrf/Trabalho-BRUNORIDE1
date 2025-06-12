<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../model/Veiculo.php';

// Busca os dados do veículo pelo ID passado na URL
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
<html>
<head>
    <title>Excluir Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Excluir Veículo</h2>
    <div class="alert alert-warning">
        Tem certeza que deseja excluir o veículo <strong><?= htmlspecialchars($veiculo['modelo']) ?></strong> (Placa: <?= htmlspecialchars($veiculo['placa']) ?>)?
    </div>
    <form action="../../controller/VeiculoController.php" method="post">
        <input type="hidden" name="acao" value="excluir">
        <input type="hidden" name="id" value="<?= htmlspecialchars($veiculo['id']) ?>">
        <button type="submit" class="btn btn-danger">Sim, excluir</button>
        <a href="ListarVeiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>