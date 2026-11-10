<?php
require_once __DIR__ . "/../auth/autenticacao.php";
require_once __DIR__ . "/../models/vacinacao.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$id = $_POST['id'];

$vacina = new Vacinacao($id);
$vacina->deletar();

header('Location: /vacine_ai/views/exibir_vacinas.php');
exit;