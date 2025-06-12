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
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 30px 0;
            margin-top: auto;
        }

        footer p,
        footer small {
            margin: 0;
        }

        footer .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 1.25rem;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        footer .social-icons a:hover {
            color: #0d6efd;
            transform: scale(1.1);
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
                    <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Minhas Corridas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
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
                            <input type="hidden" name="motorista_id" value="<?= htmlspecialchars($motorista_id); ?>">
                            <div class="mb-3">
                                <label class="form-label">ID do Motorista:</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($motorista_id); ?>" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer text-white py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-3 mb-md-0 text-center text-md-start">
            <p class="mb-0">&copy; 2025 Uber Clone — Todos os direitos reservados.</p>
            <small class="text-muted">Construído com ❤️ para facilitar suas viagens.</small>
        </div>
        <div class="social-icons text-center text-md-end">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
    </div>
</footer>

</body>
</html>
