CREATE DATABASE IF NOT EXISTS vacine_ai
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE vacine_ai;

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    dt_nascimento DATE NOT NULL,
    genero VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    nivel_acesso INT NOT NULL DEFAULT 1,
    telefone VARCHAR(20),
    cpf VARCHAR(11) NOT NULL UNIQUE
);

CREATE TABLE vacina (
    id_vacina INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    qtd_doses INT NOT NULL,
    periodo INT,
    CONSTRAINT chk_vacina_qtd_doses CHECK (qtd_doses > 0)
);

CREATE TABLE vacinacao (
    id_vacinacao INT PRIMARY KEY AUTO_INCREMENT,
    id_vacina INT NOT NULL,
    id_usuario INT NOT NULL,
    dose INT NOT NULL,
    dt_aplicacao DATE NOT NULL,

    CONSTRAINT chk_vacinacao_dose CHECK (dose > 0),
    CONSTRAINT fk_vacinacao_vacina FOREIGN KEY (id_vacina)REFERENCES vacina (id_vacina),
    CONSTRAINT fk_vacinacao_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario),
    CONSTRAINT uq_vacinacao_dose UNIQUE (id_usuario, id_vacina, dose)
);

-- seeds
INSERT INTO vacina (nome, qtd_doses, periodo) VALUES
('BCG', 1, 0),
('Hepatite B', 3, 30),
('Pentavalente', 3, 60),
('Poliomielite', 4, 60),
('Rotavírus', 2, 60),
('Pneumocócica 10-valente', 2, 60),
('Meningocócica C', 2, 60),
('Febre Amarela', 1, 0),
('Tríplice Viral', 2, 30),
('DTP', 3, 60),
('Hepatite A', 1, 0),
('HPV', 1, 0),
('Influenza', 1, 0),
('COVID-19', 2, 30),
('Varicela', 2, 90);