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
    status ENUM("Em análise", "Aprovado", "Reprovado"),
    id_aluno INT,
    id_professor INT,
    FOREIGN KEY (id_aluno) REFERENCES usuarios(id),
    FOREIGN KEY (id_mentor) REFERENCES usuarios(id)
);

INSERT INTO usuarios (nome, email, senha, is_adm) VALUES ('Aluno', 'aaa@gmail.com', '123456',0);
INSERT INTO usuarios (nome, email, senha, is_adm) VALUES ('Prof. Adm', 'adm@gmail.com', '123456',1);

CREATE OR REPLACE VIEW vw_consultar_projetos AS
SELECT 
    p.id,
    p.nome,
    p.descricao,
    p.caminho_arquivo,
    CONCAT(DATE_FORMAT(p.data_envio, '%d/%m/%Y'), ' às ', DATE_FORMAT(p.data_envio, '%H:%i')) AS data_formatada,
    p.status,
    
    -- Aluno
    p.id_aluno,
    aluno.nome AS nome_aluno,
    
    -- Mentor
    p.id_mentor,
    mentor.nome AS nome_mentor
    FROM projetos p

    LEFT JOIN usuarios aluno 
        ON p.id_aluno = aluno.id AND aluno.is_adm = 0

    LEFT JOIN usuarios mentor 
        ON p.id_mentor = mentor.id AND mentor.is_adm = 1;



CREATE USER 'admnicbd'@'localhost' IDENTIFIED BY 'PhP@12345678900.';
GRANT ALL ON nic_bd.* TO 'admnicbd'@'localhost';