<?php
require_once __DIR__ . "/../configs/conexao.php";

class Vacinacao
{
    private $id_vacinacao;
    private $id_vacina;
    private $id_usuario;
    private $dt_ultima;
    private $dt_proxima;
    private $dose;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_vacinacao = $id;
            $this->carregar();
        }
    }

    public function carregar(){
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM vacinacao WHERE id_vacinacao=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->getId_vacinacao());
        $stmt->execute();
        $resultado= $stmt->fetch();

        if ($resultado){
            $this->id_vacina = $resultado['id_vacina'];
            $this->setId_usuario($resultado['id_usuario']);
            $this->setDt_ultima($resultado['dt_aplicacao']);
            $this->setDt_proxima($resultado['dt_proxima']);
            $this->setDose($resultado['dose']);
            

        }
    }

    public function inserir()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO vacinacao (id_vacina, id_usuario, dt_aplicacao, dt_proxima, dose) values (:vacina, :usuario, :dt_aplicacao, :dt_proxima, :dose);";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':vacina', $this->getId_vacina());
            $stmt->bindValue(':usuario', $this->getId_usuario());
            $stmt->bindValue(':dt_aplicacao', $this->getDt_ultima());
            $stmt->bindValue(':dt_proxima', $this->getDt_proxima());
            $stmt->bindValue(':dose', $this->getDose());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizar(){
        try {
            $conexao = Conexao::conectar();
            $sql = "UPDATE vacinacao SET id_vacina =:id_vacina, dt_aplicacao =:dt_aplicacao, dt_proxima =:dt_proxima, dose=:dose WHERE id_vacinacao=:id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id_vacina', $this->getId_vacina());
            $stmt->bindValue(':dt_aplicacao', $this->getDt_ultima());
            $stmt->bindValue(':dt_proxima', $this->getDt_proxima());
            $stmt->bindValue(':dose', $this->getDose());
            $stmt->bindValue(':id', $this->getId_vacinacao());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function listar()
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM vacinacao";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            echo 'Erro ao buscar vacina: ' . $e->getMessage();
        }
    }

    public static function listarTomadasPorUsuario($id_usuario)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT vc.*, u.nome, v.nome as nome_vacina, v.qtd_doses FROM vacinacao vc JOIN usuario u ON vc.id_usuario = u.id_usuario JOIN vacina v ON v.id_vacina = vc.id_vacina WHERE dt_aplicacao <= CURDATE() AND vc.id_usuario = :id_usuario";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            echo 'Erro ao buscar vacina: ' . $e->getMessage();
        }
    }

    public static function listarFaltantesPorUsuario($id_usuario)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT vc.*, u.nome, v.nome as nome_vacina, v.qtd_doses FROM vacinacao vc JOIN usuario u ON vc.id_usuario = u.id_usuario JOIN vacina v ON v.id_vacina = vc.id_vacina WHERE dt_proxima > CURDATE() AND vc.id_usuario = :id_usuario";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            echo 'Erro ao buscar vacina: ' . $e->getMessage();
        }
    }

    public function getId_vacinacao()
    {
        return $this->id_vacinacao;
    }

    public function setId_vacinacao($id_vacinacao): void
    {
        $this->id_vacinacao = $id_vacinacao;
    }

    public function getId_vacina()
    {
        return $this->id_vacina;
    }

    public function setId_vacina($id_vacina): void
    {
        $this->id_vacina = $id_vacina;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function getDt_ultima()
    {
        return $this->dt_ultima;
    }

    public function setDt_ultima($dt_ultima): void
    {
        $this->dt_ultima = $dt_ultima;
    }

    public function getDt_proxima()
    {
        return $this->dt_proxima;
    }

    public function setDt_proxima($dt_proxima): void
    {
        $this->dt_proxima = $dt_proxima;
    }

    public function getDose()
    {
        return $this->dose;
    }

    public function setDose($dose): void
    {
        $this->dose = $dose;
    }
}
