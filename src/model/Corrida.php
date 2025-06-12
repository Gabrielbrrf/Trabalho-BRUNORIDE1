<?php

class Corrida
{
    private $id;
    private $origem;
    private $destino;
    private $passageiro_id;
    private $motorista_id;
    private $status;

    public function __construct($origem, $destino, $passageiro_id, $motorista_id, $status = 'pendente', $id = null)
    {
        $this->id = $id;
        $this->origem = $origem;
        $this->destino = $destino;
        $this->passageiro_id = $passageiro_id;
        $this->motorista_id = $motorista_id;
        $this->status = $status;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getOrigem() { return $this->origem; }
    public function getDestino() { return $this->destino; }
    public function getPassageiroId() { return $this->passageiro_id; }
    public function getMotoristaId() { return $this->motorista_id; }
    public function getStatus() { return $this->status; }

    // Setters
    public function setOrigem($origem) { $this->origem = $origem; }
    public function setDestino($destino) { $this->destino = $destino; }
    public function setPassageiroId($passageiro_id) { $this->passageiro_id = $passageiro_id; }
    public function setMotoristaId($motorista_id) { $this->motorista_id = $motorista_id; }
    public function setStatus($status) { $this->status = $status; }
}
?>