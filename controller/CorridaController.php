<?php
require_once __DIR__ . '/../config/conexao.php';

class CorridaController {
    public function cadastrarCorrida($origem, $destino, $passageiro_id, $motorista_id) {
        global $conexao;

        $status = 'pendente';

        $stmt = $conexao->prepare("INSERT INTO corridas (origem, destino, passageiro_id, motorista_id, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiis", $origem, $destino, $passageiro_id, $motorista_id, $status);
        $stmt->execute();
        $id = $conexao->insert_id; // <-- pega o ID gerado
        $stmt->close();
        return $id;
    }

    public function listarCorridasPorMotorista($motorista_id) {
        global $conexao;
        $sql = "SELECT * FROM corridas WHERE motorista_id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $motorista_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function listarCorridasPorPassageiro($passageiro_id) {
        global $conexao;
        $sql = "SELECT * FROM corridas WHERE passageiro_id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $passageiro_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function editarCorrida($id, $origem, $destino) {
        global $conexao;
        $sql = "UPDATE corridas SET origem = ?, destino = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssi", $origem, $destino, $id);
        return $stmt->execute();
    }

    public function excluirCorrida($id) {
        global $conexao;
        $sql = "DELETE FROM corridas WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

// 👇 Execução direta se o formulário POST for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar') {
    $origem = $_POST['origem'] ?? '';
    $destino = $_POST['destino'] ?? '';

    // Buscar um motorista válido
    global $conexao;
    $res = $conexao->query("SELECT id FROM motoristas LIMIT 1");
    $row = $res->fetch_assoc();
    $motorista_id = $row ? $row['id'] : null;

    $passageiro_id = 1; // Ajuste conforme necessário

    if ($motorista_id) {
        $controller = new CorridaController();
        $id = $controller->cadastrarCorrida($origem, $destino, $passageiro_id, $motorista_id);
        // Redireciona já com o id da corrida criada
        header("Location: ../view/ClienteView/CorridaConfirmada.php?id=" . urlencode($id) . "&origem=" . urlencode($origem) . "&destino=" . urlencode($destino));
        exit();
    } else {
        echo "<script>alert('Nenhum motorista cadastrado.'); window.history.back();</script>";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editar') {
    $id = $_POST['id'] ?? null;
    $origem = $_POST['origem'] ?? '';
    $destino = $_POST['destino'] ?? '';

    if ($id) {
        $controller = new CorridaController();
        $controller->editarCorrida($id, $origem, $destino);
        header("Location: ../view/ClienteView/CorridaConfirmada.php?id=" . urlencode($id) . "&origem=" . urlencode($origem) . "&destino=" . urlencode($destino));
        exit();
    } else {
        echo "<script>alert('ID da corrida não informado.'); window.history.back();</script>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    $id = $_GET['id'] ?? null;

    if ($id) {
        $controller = new CorridaController();
        $controller->excluirCorrida($id);
        header("Location: ../view/ClienteView/HistoricoViagens.php");
        exit();
    } else {
        echo "<script>alert('ID da corrida não informado.'); window.history.back();</script>";
    }
}
