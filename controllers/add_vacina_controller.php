<?php
require_once __DIR__ . "/../models/vacinacao.php";
require_once __DIR__ . "/../auth/autenticacao.php";

Autenticacao::iniciarSessao();

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$usuario = $_SESSION['id_usuario'];
$vacina = (int)$_POST['vacina'];
$dose = (int)$_POST['dose'];
$dt_aplicacao = $_POST['data_aplicacao'];
$dt_proxima = $_POST['proxima_vacinacao'];

$vacinacao = new Vacinacao();
$vacinacao->setId_usuario($usuario);
$vacinacao->setId_vacina($vacina);
$vacinacao->setDose($dose);
$vacinacao->setDt_ultima($dt_aplicacao);
$vacinacao->setDt_proxima($dt_proxima);
$vacinacao->inserir();



header('Location: /vacine_ai/views/exibir_vacinas.php');
exit();
