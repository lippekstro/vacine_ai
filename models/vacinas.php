<?php
require_once __DIR__ . '/../configs/conexao.php';

class Vacina
{
    private $id_vacina;
    private $nome;
    private $qtd_doses;
    private $periodo;

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

    public function setId($id_vacina)
    {
        $this->id_vacina = $id_vacina;
    }

    public function getQtd()
    {
        return $this->qtd_doses;
    }

    public function setQtd($qtd_doses)
    {
        $this->qtd_doses = $qtd_doses;
    }

    public function criar()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO vacina (nome, qtd_doses, periodo) VALUES (:nome, :qtd_doses, :periodo)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindvalue(':nome', $this->getNome());
            $stmt->bindvalue(':qtd_doses', $this->getQtd());
            $stmt->bindvalue(':periodo', $this->getPeriodo());
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
            $sql = "UPDATE vacina SET nome = :nome, qtd_doses = :qtd_doses, periodo = :periodo Where id_vacina = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindvalue(':nome', $this->getNome());
            $stmt->bindvalue(':qtd_doses', $this->getQtd());
            $stmt->bindvalue(':periodo', $this->getPeriodo());
            $stmt->bindvalue(':id', $this->getId());

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
      public function carregar()
    {
        try{
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM vacina WHERE id_vacina = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindvalue(':id', $this->getId());
        $stmt->execute();
        $resultado = $stmt->fetch();
        $this->setNome($resultado['nome']);
        $this->setQtd($resultado['qtd_doses']);       
    } catch (PDOException $e){
        echo $e->getMessage();
    }
}


    public function getPeriodo()
    {
        return $this->periodo;
    }

    public function setPeriodo($periodo): void
    {
        $this->periodo = $periodo;
    }
}