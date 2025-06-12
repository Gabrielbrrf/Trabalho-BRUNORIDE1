<?php
// PerfilMotorista.php
session_start();

$conn = new mysqli('localhost', 'root', '', 'sistema_transporte');
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$email = $_GET['email'] ?? '';
$email = $conn->real_escape_string($email);

$sql = "SELECT email FROM motoristas WHERE email = '$email' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $motorista = $result->fetch_assoc();
} else {
    echo "Motorista não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Perfil Motorista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        header {
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
        }
                /* Rodapé */
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
        main.container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 15px;
        }
        .profile-pic img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 10px #90ee90;
            margin-bottom: 25px;
        }
        .email {
            font-size: 1.5rem;
            font-weight: 600;
            color: #90ee90;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BlackDrive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= 'HistoricoViagens.php' ?>">Minhas Corridas</a></li>

                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container">
    <div class="profile-pic">
        <img src="../../style/icons/Capy.jpg" alt="Ícone X" />
    </div>
    <div class="email"><?= htmlspecialchars($motorista['email']) ?></div>
</main>

<footer>
        <div class="container">
            <div class="contact-info">
                <p>📧 <a href="mailto:blackdrive@corridas" class="footer-link">blackdrive@corridas</a></p>
                <p>📍 Av. Brasil, São Paulo-SP, Brasil</p>
            </div>
            <div class="social-icons">
                <a href="#" aria-label="Baixar no Google Play">
                    <img src="../../style/icons/google-play.svg" alt="Google Play">
                </a>
                <a href="https://instagram.com/BlackDrive" target="_blank" aria-label="Instagram">
                    <img src="../../style/icons/instagram.svg" alt="Instagram">
                </a>
                <a href="https://x.com/BlackDrive" target="_blank" aria-label="X">
                    <img src="../../style/icons/x.svg" alt="X">
                </a>
            </div>
            <p class="footer-copy">&copy; 2025 BlackDrive. Todos os direitos reservados.</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
