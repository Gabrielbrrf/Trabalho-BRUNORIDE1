<?php
require_once '../config/conexao.php';
require_once 'CorridaController.php';
session_start();

// Verifica se veio via POST e se a ação é 'criar'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar') {
    
    $origem = $_POST['origem'] ?? '';
    $destino = $_POST['destino'] ?? '';

    // Pegue o passageiro_id da sessão ou defina um fixo para testes
    $passageiro_id = $_SESSION['usuario_id'] ?? 1;

    // Por enquanto vamos deixar o motorista como NULL
    $motorista_id = null;

    $controller = new CorridaController();
    $controller->cadastrarCorrida($origem, $destino, $passageiro_id, $motorista_id);
} else {
    echo "Requisição inválida.";
}
