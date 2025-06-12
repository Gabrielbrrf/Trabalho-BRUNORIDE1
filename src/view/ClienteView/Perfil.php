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
    <!-- Font Awesome para ícones -->
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
        footer {
            background-color: #000;
            color: #ccc;
            text-align: center;
            padding: 15px;
            margin-top: auto;
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
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Uber Clone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Minhas Corridas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container">
    <div class="profile-pic"></div>
    <div class="email"><?= htmlspecialchars($passageiro['email']) ?></div>
</main>

<footer>
    &copy; 2025 Uber Clone - Todos os direitos reservados.
</footer>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
