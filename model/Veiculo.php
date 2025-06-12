<?php
require_once __DIR__ . '/../config/conexao.php';

class Veiculo
{
    private $id;
    private $modelo;
    private $placa;
    private $motorista_id;

    public function __construct($modelo, $placa, $motorista_id, $id = null)
    {
        $this->id = $id;
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->motorista_id = $motorista_id;
    }

    public function getId() { return $this->id; }
    public function getModelo() { return $this->modelo; }
    public function setModelo($modelo) { $this->modelo = $modelo; }
    public function getPlaca() { return $this->placa; }
    public function setPlaca($placa) { $this->placa = $placa; }
    public function getMotoristaId() { return $this->motorista_id; }
    public function setMotoristaId($motorista_id) { $this->motorista_id = $motorista_id; }

    // Inserir novo veículo
    public function inserir()
    {
        global $conexao;
        $sql = "INSERT INTO veiculos (modelo, placa, motorista_id) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssi", $this->modelo, $this->placa, $this->motorista_id);
        return $stmt->execute();
    }

    // Editar veículo existente
    public function editar()
    {
        global $conexao;
        $sql = "UPDATE veiculos SET modelo = ?, placa = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssi", $this->modelo, $this->placa, $this->id);
        return $stmt->execute();
    }

    // Excluir veículo
    public function excluir()
    {
        global $conexao;
        $sql = "DELETE FROM veiculos WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    // Listar veículos de um motorista
    public static function listarPorMotorista($motorista_id)
    {
        global $conexao;
        $sql = "SELECT * FROM veiculos WHERE motorista_id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $motorista_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>