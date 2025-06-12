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
    <title>Editar Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Editar Veículo</h2>
    <form action="../../controller/VeiculoController.php" method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?= htmlspecialchars($veiculo['id']) ?>">
        <div class="mb-3">
            <label>Modelo:</label>
            <input type="text" name="modelo" class="form-control" value="<?= htmlspecialchars($veiculo['modelo']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Placa:</label>
            <input type="text" name="placa" class="form-control" value="<?= htmlspecialchars($veiculo['placa']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="ListarVeiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>