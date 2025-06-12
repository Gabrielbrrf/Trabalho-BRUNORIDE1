<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../controller/CorridaController.php';

$passageiro_id = $_SESSION['usuario']['id'];
$controller = new CorridaController();
$viagens = $controller->listarCorridasPorPassageiro($passageiro_id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Histórico de Viagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #000;
            color: #eee;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        header {
            background-color: #000;
            padding: 15px 30px;
            box-shadow: 0 2px 6px rgba(255,255,255,0.1);
        }

        header .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-weight: 500;
            margin-left: 20px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ccc;
            text-decoration: underline;
        }

        main.container {
            flex-grow: 1;
            max-width: 900px;
            margin: 3rem auto 4rem auto;
            background-color: #1a1a1a;
            padding: 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgb(255 255 255 / 0.1);
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1.8rem;
            text-align: center;
        }

        table {
            background-color: #111;
            color: #eee;
        }

        th, td {
            text-align: center;
            vertical-align: middle;
        }

        thead {
            background-color: #222;
        }

        .btn-primary {
            background-color: #fff;
            border: 2px solid #fff;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            color: #000;
            transition: background-color 0.25s ease, border-color 0.25s ease;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #ddd;
            border-color: #ddd;
        }

        .btn-secondary {
            background-color: #444;
            color: #eee;
            border: none;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.25s ease;
            margin-top: 1rem;
            display: inline-block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #666;
            color: #fff;
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

        @media (max-width: 480px) {
            main.container {
                margin: 2rem 1rem 3rem 1rem;
                padding: 1.5rem 1.8rem;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                margin: 0 0 1rem 0;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1e1e1e;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">BlackDrive</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" ...>
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="HistoricoCorrida.php">Minhas Corridas</a></li>
          <a class="nav-link" href="/Trabalho-BRUNORIDE1/src/view/ClienteView/PerfilPassageiro.php?email=<?= urlencode($_SESSION['usuario']['email']) ?>">Perfil</a>
          <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>


    <main class="container">
        <h2>Histórico de Viagens</h2>
        <table class="table table-bordered table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Status</th>
                    <th>Motorista</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($viagens): ?>
                    <?php foreach ($viagens as $viagem): ?>
                        <tr>
                            <td><?= htmlspecialchars($viagem['id']) ?></td>
                            <td><?= htmlspecialchars($viagem['origem']) ?></td>
                            <td><?= htmlspecialchars($viagem['destino']) ?></td>
                            <td><?= htmlspecialchars($viagem['status']) ?></td>
                            <td><?= htmlspecialchars($viagem['motorista_id']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma viagem encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="Dashboard.php" class="btn btn-secondary">Voltar ao Dashboard</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
