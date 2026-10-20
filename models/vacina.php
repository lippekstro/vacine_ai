<?php 
require_once __DIR__ . "/../templates/_cabecalho.php";

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
            $sql = "INSERT INTO vacinacao (vacina, usuario, dt_ultima, dt_proxima, dose) values (:vacina, :usuario, :dt_ultima, :dt_proxima, :dose);";
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
            $sql = "SELECT vacina.*, categoria.nome FROM vacinacao JOIN categoria ON vacina.id_categoria = categoria.id_categoria";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            echo 'Erro ao buscar vacina: ' . $e->getMessage();
        }
    }
}


