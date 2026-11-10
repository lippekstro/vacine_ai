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

$_SESSION['tipo_alerta'] = 'danger'; // define a cor da msg
$_SESSION['alerta_msg'] = 'Vacina deletada com sucesso!'; // define a msg

header('Location: /vacine_ai/views/exibir_vacinas.php');
exit;