<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/vacine_ai/models/usuario.php";
require_once __DIR__ . "/../auth/autenticacao.php";

Autenticacao::iniciarSessao();

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

$nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_SPECIAL_CHARS);
$telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_SPECIAL_CHARS);
$genero = filter_var($_POST['genero'], FILTER_SANITIZE_SPECIAL_CHARS);
$nascimento = filter_var($_POST['nascimento']);
if (!empty($_FILES['foto']['name'])) {
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

// tento criar o novo usuario
try {
    $novoUsuario->criar();
    // se der tudo certo mostra uma flash message de sucesso
    $_SESSION['tipo_alerta'] = 'success';
    $_SESSION['alerta_msg'] = 'Cadastro realizado com sucesso!';

    header("Location: /vacine_ai/views/login.php");
    exit();
} catch (PDOException $e) {
    // se der erro
    // vamos ver se foi o erro 1062 (indica que algum valor violou uma restrição UNIQUE)
    // email e cpf nao podem repetir
    if ($e->errorInfo[1] == 1062) {
        // se foi isso mensagem especifica
        $_SESSION['tipo_alerta'] = 'danger';
        $_SESSION['alerta_msg'] = 'O email ou cpf já está cadastrado!';
    } else {
        // se foi outro tipo de erro, uma mensagem generica
        $_SESSION['tipo_alerta'] = 'danger';
        $_SESSION['alerta_msg'] = 'Ocorreu um erro ao realizar o cadastro.';
    }

    header("Location: /vacine_ai/views/cadastro_usuario.php");
    exit();
}
