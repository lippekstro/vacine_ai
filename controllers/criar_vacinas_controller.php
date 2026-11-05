<?php
require_once __DIR__ . "/../auth/autenticacao.php";

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

header('Location: /vacine_ai/index.php');
exit;