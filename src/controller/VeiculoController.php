<?php
require_once __DIR__ . '/../model/Veiculo.php';

class VeiculoController {
    public function cadastrarVeiculo($modelo, $placa, $motorista_id) {
        $veiculo = new Veiculo($modelo, $placa, $motorista_id);
        if ($veiculo->inserir()) {
            echo "<script>alert('Veículo cadastrado com sucesso!'); window.location.href = '../view/MotoristaView/ListarVeiculos.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar veículo.'); window.history.back();</script>";
        }
    }

    public function editarVeiculo($id, $modelo, $placa) {
        $veiculo = new Veiculo($modelo, $placa, null, $id);
        if ($veiculo->editar()) {
            echo "<script>alert('Veículo editado com sucesso!'); window.location.href = '../view/MotoristaView/ListarVeiculos.php';</script>";
        } else {
            echo "<script>alert('Erro ao editar veículo.'); window.history.back();</script>";
        }
    }

    public function excluirVeiculo($id) {
        $veiculo = new Veiculo(null, null, null, $id);
        if ($veiculo->excluir()) {
            echo "<script>alert('Veículo excluído com sucesso!'); window.location.href = '../view/MotoristaView/ListarVeiculos.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir veículo.'); window.history.back();</script>";
        }
    }

    public function listarVeiculosPorMotorista($motorista_id) {
        return Veiculo::listarPorMotorista($motorista_id);
    }
}

// Processamento de requisições POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $controller = new VeiculoController();

    if ($acao === 'cadastrar') {
        $controller->cadastrarVeiculo($_POST['modelo'], $_POST['placa'], $_POST['motorista_id']);
    } elseif ($acao === 'editar') {
        $controller->editarVeiculo($_POST['id'], $_POST['modelo'], $_POST['placa']);
    } elseif ($acao === 'excluir') {
        $controller->excluirVeiculo($_POST['id']);
    }
}
