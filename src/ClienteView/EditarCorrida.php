<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}

// Recupera os dados da corrida via GET
$id = $_GET['id'] ?? '';
$origem = $_GET['origem'] ?? '';
$destino = $_GET['destino'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Corrida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Editar Corrida</h2>
    <form method="post" action="../../controller/CorridaController.php">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" class="form-control" name="origem" id="origem" value="<?= htmlspecialchars($origem) ?>" required>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" class="form-control" name="destino" id="destino" value="<?= htmlspecialchars($destino) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="CorridaConfirmada.php?id=<?= urlencode($id) ?>&origem=<?= urlencode($origem) ?>&destino=<?= urlencode($destino) ?>" class="btn btn-secondary">Cancelar</a>
    </form>

</body>
</html>