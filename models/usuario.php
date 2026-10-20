<?php 

class Usuario {
    private $id_usuario;
    private $email;
    private $senha;
    private $dt_nascimento;
    private $genero;
    private $cpf;
    private $telefone;
    private $foto;
    private $nome;
    private $nivel_acesso

    public function __construct($id = false) {
        if ($id) {
            $this->id_usuario = $id;
            $this->carregar();
        }
    }

    public function getId() {
        return $this->id_usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getNivel() {
        return $this->nivel_acesso;
    }

    public function setNivel($nivel) {
        $this->nivel_acesso = $nivel;
    }

    public function getNascimento() {
        return $this->dt_nascimento;
    }

    public function setNascimento($nascimento) {
        $this->dt_nascimento = $nascimento;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
}
