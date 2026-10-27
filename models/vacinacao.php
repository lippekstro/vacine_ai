<?php 
require_once __DIR__ . "/../configs/conexao.php";

class Vacinacao {
    private $id_vacinacao;
    private $id_vacina;
    private $id_usuario;
    private $dt_ultima;
    private $dt_proxima;
    private $dose;

    public function inserir(){
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO vacinacao (id_vacina, id_usuario, dt_ultima, dt_proxima, dose) values (:vacina, :usuario, :dt_ultima, :dt_proxima, :dose);";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':vacina', $this->getId());
            $stmt->bindValue(':usuario', $this->getUsuario());
            $stmt->bindValue(':dt_ultima', $this->getDt_ultima());
            $stmt->bindValue (':dt_proxima', $this->getDt_proxima());
            $stmt->bindValue (':dose', $this->getDose());
            $stmt->execute();
        } catch  (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function getId() {
        return $this->id_vacina;
    }

    public function getUsuario() {
        return $this->id_usuario;
    }

    public function getDt_ultima() {
        return $this->dt_ultima;
    }

    public function getDt_proxima() {
        return $this->dt_proxima;
    }

        public function getDose() {
        return $this->dose;
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


    public function setId_vacinacao($id_vacinacao): void
    {
        $this->id_vacinacao = $id_vacinacao;
    }

    public function setId_vacina($id_vacina): void
    {
        $this->id_vacina = $id_vacina;
    }

    public function setId_usuario($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function setDt_ultima($dt_ultima): void
    {
        $this->dt_ultima = $dt_ultima;
    }

    public function setDt_proxima($dt_proxima): void
    {
        $this->dt_proxima = $dt_proxima;
    }

    public function setDose($dose): void
    {
        $this->dose = $dose;
    }
}


