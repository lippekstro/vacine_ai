<?php 
require_once __DIR__ . "/../models/vacinacao.php";

$usuario = 1;
$vacina = (int)$_POST ['vacina'];
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

header('Location: /vacine_ai/views/cadastrar_vacina.php');
exit();