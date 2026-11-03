<?php
require_once __DIR__ . "/../auth/autenticacao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

Autenticacao::login($email, $senha);