<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'motorista') {
    header('Location: ../Login.php');
    exit();
}

require_once '../../config/conexao.php';

$motorista_id = $_SESSION['usuario']['id'];
$sql = "SELECT * FROM corridas WHERE motorista_id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $motorista_id);
$stmt->execute();
$result = $stmt->get_result();
$viagens = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Viagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
 <style>
    body {
        background-color: #121212; /* fundo escuro */
        color: #ffffff; /* texto branco */
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
        flex: 1;
        max-width: 1000px;
        margin: 30px auto;
        background-color: #1e1e1e; /* card escuro */
        color: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .table {
    width: 100%;
    border-collapse: collapse;
    background-color: #222; /* fundo escuro, mas confortável */
    color: #eee; /* texto claro */
    border-radius: 10px;
    overflow: hidden;
}

.table thead {
    background-color: #333; /* cabeçalho um pouco mais claro */
    color: #fff;
    font-weight: bold;
}

.table th,
.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #444;
}

.table tbody tr:hover {
    background-color: #444; /* hover para destacar linha */
}

.table tbody tr:last-child td {
    border-bottom: none;
}


    .btn-secondary {
        background-color: #444;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #666;
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
            <a class="navbar-brand" href="#">🚗 BlackDrive</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                    <a class="nav-link" href="/Trabalho-BRUNORIDE1/src/view/MotoristaView/PerfilMotorista.php?email=<?= urlencode($_SESSION['usuario']['email']) ?>">Perfil</a>
                    <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <h2>Histórico de Viagens</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Status</th>
                <th>Passageiro</th>
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
                        <td><?= htmlspecialchars($viagem['passageiro_id']) ?></td>
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

</body>
</html>
