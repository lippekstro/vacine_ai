CREATE DATABASE vacine_ai;


use vacine_ai;

CREATE TABLE usuario {
    id_usuario INT PRIMARY KEY AUTO_INCREMENT, 
    nome VARCHAR(255) NOT NULL,
    dt_nascimento DATE NOT NULL,
    genero VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    nivel de acesso INT DEFAULT 1,
    telefone VARCHAR(255),
    cpf VARCHAR(255) NOT NULL UNIQUE
}
CREATE TABLE vacina {
    id_vacina INT PRIMARY KEY AUTO AUTO_INCREMENT,
    nome 
    qtd_doses
}

CREATE TABLE vacinacao {
    id_vacinacao INT PRIMARY KEY AUTO AUTO_INCREMENT,
    id_vacina,
    id_usuario,
    dt_ultima,
    dt_proxima
}