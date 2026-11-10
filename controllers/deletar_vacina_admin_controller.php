<?php
require_once __DIR__ . "/../auth/autenticacao.php";
require_once __DIR__ . "/../models/vacinas.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$id = $_POST['id'];

$vacina = new Vacina($id);
$vacina->deletar();

header('Location: /vacine_ai/views/gerenciar_vacinas_site.php');
exit;