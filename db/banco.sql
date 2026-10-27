CREATE DATABASE vacine_ai;

USE vacine_ai;


CREATE TABLE usuario {
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    dt_nascimento DATE NOT NULL,
    genero VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    nivel_acesso INT DEFAULT 1,
    telefone VARCHAR(255),
    cpf VARCHAR(255) NOT NULL UNIQUE
}

CREATE TABLE vacina {
    id_vacina INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    qtd_doses INT NOT NULL
}

CREATE TABLE vacinacao {
    id_vacinacao INT PRIMARY KEY AUTO_INCREMENT,
    id_vacina INT,
    id_usuario INT,
    dt_ultima DATE,
    dt_proxima DATE
}