<?php
session_start();

$host = 'localhost';
$db   = 'sistema_transporte';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die("Falha na conexão com o banco: " . $mysqli->connect_error);
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $mysqli->real_escape_string($_POST['email']);

    // Verifica se o email existe em passageiros ou motoristas
    $queryPassageiro = "SELECT * FROM passageiros WHERE email = '$email' LIMIT 1";
    $resultPassageiro = $mysqli->query($queryPassageiro);

    $queryMotorista = "SELECT * FROM motoristas WHERE email = '$email' LIMIT 1";
    $resultMotorista = $mysqli->query($queryMotorista);

    if ($resultPassageiro->num_rows > 0 || $resultMotorista->num_rows > 0) {
        // Gera token seguro
        $token = bin2hex(random_bytes(16));

        // Salva token na tabela senha_recuperacao
        $stmt = $mysqli->prepare("INSERT INTO senha_recuperacao (email, token) VALUES (?, ?)");
        $stmt->bind_param('ss', $email, $token);
        $stmt->execute();
        $stmt->close();

        // Monta link para recuperação, ajuste conforme sua URL e pasta
        $link = "http://localhost/Trabalho-BRUNORIDE1/src/view/RedefinirSenha.php?token=$token";

        // Mensagem de email simples (pode melhorar com PHPMailer)
        $assunto = "Recuperação de senha BlackDrive";
        $mensagem = "Olá,\n\nRecebemos um pedido para redefinir sua senha.\n";
        $mensagem .= "Clique no link abaixo para criar uma nova senha:\n\n$link\n\n";
        $mensagem .= "Se você não solicitou, ignore este email.\n\nAtenciosamente,\nBlackDrive";

        $headers = "From: no-reply@blackdrive.com";

        // Envia email - no XAMPP pode ser necessário configurar servidor SMTP ou usar ferramenta de teste
        if (mail($email, $assunto, $mensagem, $headers)) {
            $msg = "Um link para redefinir a senha foi enviado para o email informado, se existir em nosso sistema.";
        } else {
            $msg = "Erro ao enviar o email. Por favor, tente novamente mais tarde.";
        }

    } else {
        $msg = "Email não encontrado no sistema. Verifique e tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Recuperar Senha - BlackDrive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #000;
            color: #eee;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
            font-weight: bold;
            font-size: 1.5rem;
        }
        main.container {
            flex-grow: 1;
            max-width: 400px;
            margin: 3rem auto;
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }
        h2 {
            color: #eee;
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-weight: 600;
            color: #ddd;
        }
        input[type="email"] {
            background-color: #2a2a2a;
            border: none;
            color: #eee;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        input[type="email"]::placeholder {
            color: #888;
        }
        button {
            background-color: #000;
            border: 2px solid #eee;
            color: #eee;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        button:hover {
            background-color: #eee;
            color: #000;
        }
        .msg {
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }
        .msg.success {
            color: #28a745;
        }
        .msg.error {
            color: #dc3545;
        }
        footer {
            background-color: #2a2a2a;
            color: #ccc;
            text-align: center;
            padding: 2rem 0;
            width: 100%;
            margin-top: auto;
        }
        footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        footer .contact-info p,
        footer .footer-copy {
            margin: 0.5rem 0;
        }
        footer .footer-link {
            color: #808080;
            text-decoration: none;
        }
        footer .footer-link:hover {
            color: #A9A9A9;
            text-decoration: underline;
        }
        footer .social-icons {
            margin: 1rem 0;
        }
        footer .social-icons a {
            margin: 0 0.5rem;
        }
        footer .social-icons img {
            width: 32px;
            height: 32px;
            filter: invert(80%) sepia(20%) hue-rotate(30deg);
            transition: filter 0.3s;
        }
        footer .social-icons img:hover {
            filter: invert(50%) sepia(90%) hue-rotate(10deg) brightness(1.2);
        }
        footer .footer-copy {
            font-size: 0.875rem;
            color: #777;
        }
        .link-login {
            text-align: center;
            margin-top: 15px;
        }
        .link-login a {
            color: #eee;
            text-decoration: none;
        }
        .link-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    🚗 BlackDrive
</header>

<main class="container">
    <h2>Recuperar Senha</h2>
    <?php if ($msg): ?>
        <div class="msg <?= strpos($msg, 'não encontrado') === false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">Informe seu email:</label>
        <input type="email" name="email" id="email" required placeholder="exemplo@dominio.com" />
        <button type="submit">Enviar link de recuperação</button>
    </form>
    <div class="link-login">
        <a href="Login.php">Voltar para Login</a>
    </div>
</main>

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
