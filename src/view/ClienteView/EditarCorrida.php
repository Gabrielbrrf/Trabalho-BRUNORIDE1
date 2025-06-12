<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'passageiro') {
    header('Location: ../Login.php');
    exit();
}

// Recupera os dados da corrida via GET
$id = $_GET['id'] ?? '';
$origem = $_GET['origem'] ?? '';
$destino = $_GET['destino'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Corrida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1c1c1e;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 15px 30px;
        }

        header .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-weight: 500;
            margin-left: 15px;
        }

        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }

        h2 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            color: #000;
        }


        .btn-primary {
            background-color: #000;
            border-color: #000;
            border-radius: 25px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }

        .btn-secondary {
            background-color: #e5e5ea;
            color: #000;
            border: none;
            border-radius: 25px;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-secondary:hover {
            background-color: #d1d1d6;
        }



        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: auto;
        }
    </style>
</head>
 <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Uber Clone</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Minhas Corridas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<body class="container mt-5">
    <h2 class="mb-4">Editar Corrida</h2>
    <form method="post" action="../../controller/CorridaController.php">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" class="form-control" name="origem" id="origem" value="<?= htmlspecialchars($origem) ?>" required>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" class="form-control" name="destino" id="destino" value="<?= htmlspecialchars($destino) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="CorridaConfirmada.php?id=<?= urlencode($id) ?>&origem=<?= urlencode($origem) ?>&destino=<?= urlencode($destino) ?>" class="btn btn-secondary">Cancelar</a>
    </form>
         <!-- ✅ Rodapé -->
    <footer>
        &copy; 2025 Uber Clone - Todos os direitos reservados.
    </footer>
</body>
</html>