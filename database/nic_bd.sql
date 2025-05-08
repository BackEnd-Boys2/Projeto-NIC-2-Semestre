CREATE DATABASE IF NOT EXISTS nic_bd;

USE nic_bd;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    is_adm BOOLEAN NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    caminho_arquivo VARCHAR(255) NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM("Em análise", "Aprovado", "Reprovado")
    id_aluno INT,
    FOREIGN KEY (id_aluno) REFERENCES usuarios(id)
);

INSERT INTO usuarios (nome, email, senha, is_adm) VALUES ('ADM', 'aaa@gmail.com', '123456',0);
INSERT INTO usuarios (nome, email, senha, is_adm) VALUES ('ADM', 'adm@gmail.com', '123456',1);

CREATE USER 'admnicbd'@'localhost' IDENTIFIED BY 'PhP@12345678900.';
GRANT ALL ON nic_bd.* TO 'admnicbd'@'localhost';