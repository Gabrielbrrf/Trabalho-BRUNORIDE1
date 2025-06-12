<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../model/Veiculo.php';

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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .nav-link {
            color: #fff !important;
            margin-left: 15px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        main {
            flex-grow: 1;
        }

        .card {
            border-radius: 15px;
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
    </style>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🚗 Uber Clone</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Minhas Corridas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <h2 class="mb-4">Editar Veículo</h2>
    <form action="../../controller/VeiculoController.php" method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?= htmlspecialchars($veiculo['id']) ?>">
        <div class="mb-3">
            <label class="form-label">Modelo:</label>
            <input type="text" name="modelo" class="form-control" value="<?= htmlspecialchars($veiculo['modelo']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Placa:</label>
            <input type="text" name="placa" class="form-control" value="<?= htmlspecialchars($veiculo['placa']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="ListarVeiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
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

</body>
</html>
