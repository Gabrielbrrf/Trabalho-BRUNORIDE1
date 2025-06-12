<?php
// perfil_passageiro.php
$conn = new mysqli('localhost', 'root', '', 'sistema_transporte');
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$email = $_GET['email'] ?? '';
$email = $conn->real_escape_string($email);

$sql = "SELECT email FROM passageiros WHERE email = '$email' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $passageiro = $result->fetch_assoc();
} else {
    echo "Passageiro não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Perfil Passageiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome (opcional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #808080;
        }

        .navbar-nav .nav-link {
            color: #e0e0e0;
            margin-left: 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #A9A9A9;
        }

        main.container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 15px;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #555 url('https://cdn-icons-png.flaticon.com/512/147/147144.png') no-repeat center;
            background-size: cover;
            margin-bottom: 25px;
            box-shadow: 0 0 10px #90ee90;
        }

        .email {
            font-size: 1.5rem;
            font-weight: 600;
            color: #90ee90;
        }

        footer {
            background-color: #2a2a2a;
            color: #ccc;
            text-align: center;
            padding: 2rem 0;
            width: 100%;
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
    </style>
</head>
<body>

<!-- HEADER MODERNO -->
<header class="py-3" style="background-color: #1e1e1e;">
    <nav class="container d-flex justify-content-between align-items-center">
        <a class="brand text-decoration-none" href="#">Uber Clone</a>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="HistoricoCorrida.php">Minhas Corridas</a></li>
            <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
            
        </ul>
    </nav>
</header>

<main class="container">
    <div class="profile-pic"></div>
    <div class="email"><?= htmlspecialchars($passageiro['email']) ?></div>
</main>

<!-- FOOTER MODERNO -->
<footer>
    <div class="container">
        <div class="social-icons">
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
        <div class="contact-info">
            <p>Contato: suporte@uberclone.com</p>
        </div>
        <div class="footer-copy">
            &copy; 2025 Uber Clone - Todos os direitos reservados.
        </div>
    </div>
</footer>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
