<?php
$nome_vacina = $_POST['nome'];
$qtd_doses = $_POST['qtd_doses'];

$vacinas = new Vacina();
$vacinas->setNome($nome_vacina);
$vacinas->setQtd($qtd_doses);

$vacinas->criar();

header('Location: /vacine_ai/index.php');
exit;