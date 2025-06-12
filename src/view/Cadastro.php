<?php
require_once '../controller/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $tipo = $_POST['tipo'] ?? 'passageiro';

    $auth = new AuthController();
    $auth->criarConta($email, $senha, $tipo);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Criar Conta</h2>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Senha:</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipo:</label>
                                <select name="tipo" class="form-select">
                                    <option value="passageiro">Passageiro</option>
                                    <option value="motorista">Motorista</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                        <p class="mt-3 text-center">
                            Já tem uma conta? <a href="Login.php">Fazer login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>