<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Bem-vindo, <?= htmlspecialchars($usuario['email']) ?>!</h2>
    <p>Esta é a área do cliente.</p>
    <a href="CadastroCorrida.php" class="btn btn-primary mb-3">Pedir Corrida</a>
    <a href="HistoricoViagens.php" class="btn btn-info mb-3 ms-2">Histórico de Viagens</a>
    <br>
    <a href="../../controller/logout.php" class="btn btn-danger">Sair</a>
</body>
</html>