<?php
require_once __DIR__ . "/../auth/autenticacao.php";
require_once __DIR__ . "/../models/vacinas.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$nome_vacina = $_POST['nome'];
$qtd_doses = $_POST['qtd_doses'];
$periodo = $_POST['periodo'];

$vacinas = new Vacina();
$vacinas->setNome($nome_vacina);
$vacinas->setQtd($qtd_doses);
$vacinas->setPeriodo($periodo);
$vacinas->criar();

$_SESSION['tipo_alerta'] = 'success'; // define a cor da msg
$_SESSION['alerta_msg'] = 'Nova vacina criada no sistema com sucesso!'; // define a msg

header('Location: /vacine_ai/views/gerenciar_vacinas_site.php');
exit;