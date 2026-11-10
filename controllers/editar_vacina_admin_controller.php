<?php
require_once __DIR__ . "/../auth/autenticacao.php";
require_once __DIR__ . "/../models/vacinas.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$id = $_POST['id'];
$nome_vacina = $_POST['nome'];
$qtd_doses = $_POST['qtd_doses'];
$periodo = $_POST['periodo'];

$vacinas = new Vacina($id);
$vacinas->setNome($nome_vacina);
$vacinas->setQtd($qtd_doses);
$vacinas->setPeriodo($periodo);
$vacinas->atualizar();

$_SESSION['tipo_alerta'] = 'info'; // define a cor da msg
$_SESSION['alerta_msg'] = 'Vacina atualizada no sistema com sucesso!'; // define a msg

header('Location: /vacine_ai/views/gerenciar_vacinas_site.php');
exit;