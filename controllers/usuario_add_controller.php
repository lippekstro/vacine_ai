<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/vacine_ai/models/usuario.php";

if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

$nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_SPECIAL_CHARS);
$telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_SPECIAL_CHARS);
$genero = filter_var($_POST['genero'], FILTER_SANITIZE_SPECIAL_CHARS);
$nascimento = filter_var($_POST['nascimento']);
if(!empty($_FILES['foto']['name'])) {
    $foto = $_FILES['foto'];
    $extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
    $nomefoto = uniqid() . '.' . $extensao;

    $caminho = __DIR__ . "/../imgs/fotos/" . $nomefoto;
    move_uploaded_file($foto['tmp_name'], $caminho);
} else {
    $nomefoto = null;
}

$novoUsuario = new Usuario();
$novoUsuario->setNome($nome);
$novoUsuario->setEmail($email);
$novoUsuario->setCpf($cpf);
$novoUsuario->setTelefone($telefone);
$novoUsuario->setGenero($genero);
$novoUsuario->setNascimento($nascimento);
$novoUsuario->setFoto($nomefoto);
$novoUsuario->setSenha($senha);
$novoUsuario->criar();

header("Location: /vacine_ai/views/login.php");

exit();

