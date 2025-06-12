<?php
session_start();
$motorista_id = isset($_SESSION['motorista_id']) ? $_SESSION['motorista_id'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #f1f1f1;
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
            border-radius: 15px;
            background-color: #1e1e1e;
            color: #f1f1f1;
            border: none;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background-color: #1c1c1c; /* substituindo azul */
            color: #f1f1f1;
        }

        .form-control {
            background-color: #2a2a2a;
            color: #f1f1f1;
            border: 1px solid #555;
        }

        .form-control:focus {
            background-color: #2a2a2a;
            color: #fff;
            border-color: #444;
            box-shadow: none;
        }

        .btn-primary {
            border-radius: 25px;
            font-weight: 500;
            background-color: #333;
            border: none;
        }

        .btn-primary:hover {
            background-color: #444;
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

        .id-field {
            font-weight: bold;
            font-size: 1.05rem;
            background-color: #2a2a2a;
            color: #e0e0e0;
            border: 1px solid #444;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🚗 BlackDrive</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="HistoricoViagens.php">Minhas Corridas</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Trabalho-BRUNORIDE1/src/view/MotoristaView/PerfilMotorista.php?email=<?= urlencode($_SESSION['usuario']['email']) ?>">Perfil</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="flex-grow-1">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
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
                            <input type="hidden" name="motorista_id" value="<?= htmlspecialchars($motorista_id); ?>">
                            <div class="mb-3">
                                <label class="form-label">ID do Motorista:</label>
                                <input type="text" class="form-control id-field" value="<?= htmlspecialchars($motorista_id); ?>" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
