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
('Gabriel', 'gabriel@passageiro', '12345'),
('Bruno', 'bruno@passageiro', '12345');

INSERT INTO motoristas (nome, cnh, email, senha) VALUES
('Gabriel', '12345678900', 'gabriel@motorista', '12345'),
('Bruno', '98765432100', 'bruno@motorista', '12345');

-- Passageiros adicionais
INSERT INTO passageiros (nome, email, senha) VALUES
('Ana Souza', 'ana@passageiro.com', '0987'),
('Carlos Lima', 'carlos@passageiro.com', '0987'),
('Fernanda Alves', 'fernanda@passageiro.com', '0987');

-- Motoristas adicionais
INSERT INTO motoristas (nome, cnh, email, senha) VALUES
('João Mendes', '32145678900', 'joao@motorista.com', '0987'),
('Patrícia Rocha', '65478912300', 'patricia@motorista.com', '0987'),
('Rafael Torres', '98732165400', 'rafael@motorista.com', '0987');