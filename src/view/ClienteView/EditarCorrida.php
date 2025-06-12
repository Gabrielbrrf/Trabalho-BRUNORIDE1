<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}

$id = $_GET['id'] ?? '';
$origem = $_GET['origem'] ?? '';
$destino = $_GET['destino'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Editar Corrida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Fundo preto para toda a página */
        body {
            background-color: #000;
            color: #eee;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Header preto com texto branco */
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

        /* Conteúdo central com fundo claro */
        main.container {
            flex-grow: 1;
            max-width: 600px;
            margin: 3rem auto 4rem auto;
            background-color: #1a1a1a; /* cinza escuro, para destacar do preto */
            padding: 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgb(255 255 255 / 0.1);
            color: #eee;
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1.8rem;
            text-align: center;
        }

        label.form-label {
            font-weight: 600;
            color: #ddd;
        }

        input.form-control {
            background-color: #222;
            border: 1.5px solid #444;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
            color: #eee;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input.form-control:focus {
            border-color: #fff;
            box-shadow: 0 0 8px rgba(255,255,255,0.4);
            outline: none;
            background-color: #333;
        }

        /* Botões */
        .btn-primary {
            background-color: #fff;
            border: 2px solid #fff;
            border-radius: 30px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 1.05rem;
            color: #000;
            transition: background-color 0.25s ease, border-color 0.25s ease;
            box-shadow: 0 3px 8px rgb(255 255 255 / 0.2);
            margin-right: 12px;
        }
        .btn-primary:hover {
            background-color: #ddd;
            border-color: #ddd;
            color: #000;
        }

        .btn-secondary {
            background-color: #444;
            color: #eee;
            border: none;
            border-radius: 30px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 1.05rem;
            box-shadow: 0 2px 6px rgb(255 255 255 / 0.1);
            transition: background-color 0.25s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary:hover {
            background-color: #666;
            color: #fff;
            text-decoration: none;
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
    <nav class="navbar navbar-expand-lg container-fluid px-3 px-md-5">
        <a class="navbar-brand" href="#">Uber Clone</a>
        <button class="navbar-toggler btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="Dashboard.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="HistoricoCorrida.php">Minhas Corridas</a></li>
                <li class="nav-item"><a class="nav-link" href="pPerfilPassageiro.php">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="../../controller/logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>
</header>

<main class="container">
    <h2>Editar Corrida</h2>
    <form method="post" action="../../controller/CorridaController.php" novalidate>
        <input type="hidden" name="acao" value="editar" />
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>" />

        <div class="mb-4">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" id="origem" name="origem" class="form-control" value="<?= htmlspecialchars($origem) ?>" required />
        </div>
        <div class="mb-4">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" id="destino" name="destino" class="form-control" value="<?= htmlspecialchars($destino) ?>" required />
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="CorridaConfirmada.php?id=<?= urlencode($id) ?>&origem=<?= urlencode($origem) ?>&destino=<?= urlencode($destino) ?>" class="btn btn-secondary">Cancelar</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
