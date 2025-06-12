CREATE DATABASE IF NOT EXISTS sistema_transporte;
USE sistema_transporte;

CREATE TABLE passageiros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE motoristas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cnh VARCHAR(20),
    email VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100),
    placa VARCHAR(20),
    motorista_id INT,
    FOREIGN KEY (motorista_id) REFERENCES motoristas(id)
);

CREATE TABLE corridas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origem VARCHAR(255),
    destino VARCHAR(255),
    passageiro_id INT,
    motorista_id INT,
    status VARCHAR(20),
    FOREIGN KEY (passageiro_id) REFERENCES passageiros(id),
    FOREIGN KEY (motorista_id) REFERENCES motoristas(id)
);


-- Inserindo usuários fixos
INSERT INTO passageiros (nome, email, senha) VALUES
('passageiro', 'passageiro@passageiro', '12345'),


INSERT INTO motoristas (nome, cnh, email, senha) VALUES
('motorista', '12345678900', 'motorista@motorista', '12345'),
--CREATE TABLE IF NOT EXISTS senha_recuperacao (
   -- id INT AUTO_INCREMENT PRIMARY KEY,
  --  email VARCHAR(100),
   -- token VARCHAR(255),
    --data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
   --usado BOOLEAN DEFAULT FALSE
--);

