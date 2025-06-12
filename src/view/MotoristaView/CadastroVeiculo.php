<?php
session_start();
$motorista_id = isset($_SESSION['motorista_id']) ? $_SESSION['motorista_id'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Cadastro de Veículo</h2>
                    </div>
                    <div class="card-body">
                        <form action="../../controller/VeiculoController.php" method="post">
                            <input type="hidden" name="acao" value="cadastrar">
                            <div class="mb-3">
                                <label class="form-label">Modelo:</label>
                                <input type="text" name="modelo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Placa:</label>
                                <input type="text" name="placa" class="form-control" required>
                            </div>
                            <input type="hidden" name="motorista_id" value="<?php echo htmlspecialchars($motorista_id); ?>">
                            <div class="mb-3">
                                <label class="form-label">ID do Motorista:</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($motorista_id); ?>" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>