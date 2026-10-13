CREATE TABLE usuario {
    id_usuario INT PRIMARY KEY AULTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    genero VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    nivel_acesso INT DEFAULT l,
    telefone VARCHAR(255),
    cpf VARCHAR(255) NOT NULL UNIQUE

}