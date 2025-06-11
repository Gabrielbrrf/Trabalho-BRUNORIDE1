<?php
// Importa configuração conexão
require_once __DIR__ . '/../config/conexao.php';

class AuthController {
    private $conexao;

    public function __construct() {
        global $conexao;
        // Define conexão atual
        $this->conexao = $conexao;
    }

    public function login($email, $senha, $tipo) {
        // Define tabela correta
        $tabela = $tipo == 'motorista' ? 'motoristas' : 'passageiros';

        // Consulta por usuário
        $sql = "SELECT * FROM $tabela WHERE email = ? AND senha = ?";
        $stmt = $this->conexao->prepare($sql);
        // Vincula os parâmetros
        $stmt->bind_param("ss", $email, $senha);
        // Executa a consulta
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Se usuário encontrado
        if ($resultado->num_rows > 0) {
            // Inicia a sessão
            session_start();
            // Pega dados usuário
            $usuario = $resultado->fetch_assoc();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $tipo;

            // Se for motorista
            if ($tipo === 'motorista') {
                $_SESSION['motorista_id'] = $usuario['id'];
                // Redireciona para dashboard
                header("Location: ../view/MotoristaView/Dashboard.php");
            } else {
                // Redireciona para dashboard
                header("Location: ../view/ClienteView/Dashboard.php");
            }
            exit();
        } else {
            // Login inválido mostrado
            echo "Login inválido.";
        }
    }

    public function logout() {
        // Inicia a sessão
        session_start();
        // Destroi a sessão
        session_destroy();
        // Redireciona para login
        header("Location: ../view/Login.php");
    }

    public function criarConta($email, $senha, $tipo) {
        // Define tabela correta
        $tabela = $tipo == 'motorista' ? 'motoristas' : 'passageiros';

        // Verifica e-mail existente
        $sql = "SELECT * FROM $tabela WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        // Vincula o e-mail
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // E-mail já existe
        if ($resultado->num_rows > 0) {
            echo "<script>alert('E-mail já cadastrado.'); window.history.back();</script>";
            return;
        }

        // Insere novo usuário
        $sql = "INSERT INTO $tabela (email, senha) VALUES (?, ?)";
        $stmt = $this->conexao->prepare($sql);
        // Vincula dados inserção
        $stmt->bind_param("ss", $email, $senha);
        // Executa inserção usuário
        if ($stmt->execute()) {
            echo "<script>alert('Conta criada com sucesso!'); window.location.href = '../view/Login.php';</script>";
        } else {
            echo "<script>alert('Erro ao criar conta.'); window.history.back();</script>";
        }
    }

    public function recuperarSenha($email, $tipo) {
        // Define tabela correta
        $tabela = $tipo == 'motorista' ? 'motoristas' : 'passageiros';

        // Consulta senha usuário
        $sql = "SELECT senha FROM $tabela WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        // Vincula o e-mail
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Senha encontrada retorna
        if ($resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();
            return $dados['senha'];
        } else {
            // Senha não encontrada
            return null;
        }
    }
}
