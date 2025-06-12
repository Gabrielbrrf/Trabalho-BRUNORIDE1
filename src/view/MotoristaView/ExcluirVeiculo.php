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
    <title>Excluir Veículo</title>
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

        .card {
            max-width: 600px;
            width: 100%;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        h2 {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert {
            font-size: 1.1rem;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
        }

        .btn + .btn {
            margin-left: 10px;
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
                    <li class="nav-item"><a class="nav-link" href="Perfil.php?email=SEU_EMAIL&type=passageiro">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="card">
        <h2 class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Excluir Veículo</h2>
        <div class="alert alert-warning">
            Tem certeza que deseja excluir o veículo <strong><?= htmlspecialchars($veiculo['modelo']) ?></strong><br>
            (Placa: <?= htmlspecialchars($veiculo['placa']) ?>)?
        </div>
        <form action="../../controller/VeiculoController.php" method="post" class="text-center mt-4">
            <input type="hidden" name="acao" value="excluir">
            <input type="hidden" name="id" value="<?= htmlspecialchars($veiculo['id']) ?>">
            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill me-1"></i>Sim, excluir</button>
            <a href="ListarVeiculos.php" class="btn btn-secondary">Cancelar</a>
        </form>
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
