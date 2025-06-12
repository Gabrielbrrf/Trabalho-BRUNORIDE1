<?php
// Redireciona se o usuário clicou em "Criar conta"
if (isset($_GET['acao']) && $_GET['acao'] === 'cadastrar') {
    header('Location: Cadastro.php');
    exit();
}

require_once '../controller/AuthController.php';

if (isset($_POST['acao']) && $_POST['acao'] == 'login') {
    (new AuthController())->login($_POST['email'], $_POST['senha'], $_POST['tipo']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style/style_login.css">


</head>
<body class="container mt-5">
    <div class="brand">BlackDrive</div>
    <h2 class="mb-4">Login</h2>
    <form method="post">
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label>Senha:</label>
            <input type="password" class="form-control" name="senha" required>
        </div>
        <div class="mb-3">
            <label>Tipo:</label>
            <select name="tipo" class="form-select">
                <option value="motorista">Motorista</option>
                <option value="passageiro">Passageiro</option>
            </select>
        </div>
        <button type="submit" name="acao" value="login" class="btn btn-primary">Entrar</button>
    </form>

    <form method="get" class="mt-3 text-center">
        <p> Não tem uma conta?</p>
        <button type="submit" name="acao" value="cadastrar" class="btn btn-link">Criar conta</button>
    </form>
    <div class="text-center mt-2">
        <a href="RecuperarSenha.php">Esqueci minha senha</a>
    </div>
    <footer>
        <div class="container">
            <div class="contact-info">
                <p>📧 <a href="mailto:blackdrive@corridas" class="footer-link">blackdrive@corridas</a></p>
                <p>📍 Av. Brasil, São Paulo-SP, Brasil</p>
            </div>
            <div class="social-icons">
                <a href="#" aria-label="Baixar no Google Play">
                    <img src="../style/icons/google-play.svg" alt="Google Play">
                </a>
                <a href="https://instagram.com/BlackDrive" target="_blank" aria-label="Instagram">
                    <img src="../style/icons/instagram.svg" alt="Instagram">
                </a>
                <a href="https://x.com/BlackDrive" target="_blank" aria-label="X">
                    <img src="../style/icons/x.svg" alt="X">
                </a>
            </div>
            <p class="footer-copy">&copy; 2025 BlackDrive. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>