<?php
require_once __DIR__ . '/../config/conexao.php';

class AuthController {
    private $conexao;

    public function __construct() {
        global $conexao;
        $this->conexao = $conexao;
    }

    public function login($email, $senha, $tipo) {
        $tabela = $tipo == 'motorista' ? 'motoristas' : 'passageiros';
        $sql = "SELECT * FROM $tabela WHERE email = ? AND senha = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            session_start();
            $usuario = $resultado->fetch_assoc();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $tipo;
            if ($tipo === 'motorista') {
                $_SESSION['motorista_id'] = $usuario['id'];
                header("Location: ../view/MotoristaView/Dashboard.php");
            } else {
                header("Location: ../view/ClienteView/Dashboard.php");
            }
            exit();
        } else {
            echo "Login inválido.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../view/Login.php");
    }

    public function criarConta($email, $senha, $tipo) {
        $tabela = $tipo == 'motorista' ? 'motoristas' : 'passageiros';

        // Verifica se o e-mail já existe
        $sql = "SELECT * FROM $tabela WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<script>alert('E-mail já cadastrado.'); window.history.back();</script>";
            return;
        }

        // Insere novo usuário
        $sql = "INSERT INTO $tabela (email, senha) VALUES (?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        if ($stmt->execute()) {
            echo "<script>alert('Conta criada com sucesso!'); window.location.href = '../view/Login.php';</script>";
        } else {
            echo "<script>alert('Erro ao criar conta.'); window.history.back();</script>";
        }
    }

    public function recuperarSenha($email, $tipo) {
        $tabela = $tipo == 'motorista' ? 'motoristas' : 'passageiros';

        $sql = "SELECT senha FROM $tabela WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();
            return $dados['senha'];
        } else {
            return null;
        }
    }
}
