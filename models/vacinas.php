<?php


class Vacina
{
    private $id_vacina;
    private $nome;
    private $qtd_doses;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_vacina = $id;
            $this->carregar();
        }
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getId()
    {
        return $this->id_vacina;
    }
    public function getQtd()
    {
        return $this->qtd_doses;
    }
    public function criar()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO vacina (nome, qtd_doses) VALUES (:nome, :qtd_doses)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindvalue(':nome', $this->getNome());
            $stmt->bindvalue(':qtd_doses', $this->getQtd());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function listar()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM vacina";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll();
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function deletar()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM vacina WHERE id_vacina = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindvalue(':id', $this->getId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function atualizar()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "UPDATE vacina SET nome = :nome, qtd_doses = :qtd_doses Where id_vacina = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindvalue(':nome', $this->getNome());
            $stmt->bindvalue(':qtd_doses', $this->getQtd());
            $stmt->bindvalue(':id_vacina', $this->getId());

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
      public function carregar()
    {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM vacina WHERE id_vacina = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindvalue(':id', $this->getId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
