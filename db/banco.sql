CREATE DATABASE vacine_ai;


use vacine_ai;

CREATE TABLE usuario {
    id_usuario INT PRIMARY KEY AUTO_INCREMENT, 
    nome,
    dt_nascimento,
    genero,
    email,
    senha,
    foto,
    nivel de acesso,
    telefone,
    cpf
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