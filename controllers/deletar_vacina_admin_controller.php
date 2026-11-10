<?php
require_once __DIR__ . "/../auth/autenticacao.php";
require_once __DIR__ . "/../models/vacinas.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$id = $_POST['id'];

$vacina = new Vacina($id);

// colocando o try catch no controller
// fazemos com que o tratamento de erro fique mais adequado
// aqui eu tento deletar
try {
    $vacina->deletar();
    // se der certo monta uma flash message de sucesso
    $_SESSION['tipo_alerta'] = 'success';
    $_SESSION['alerta_msg'] = 'Vacina deletada com sucesso!';
} catch (PDOException $e) {
    // se acontecer algum erro
    // vou testar se o erro é do tipo 1451 (indica que você tentou excluir um registro que possui uma referência em outra tabela)
    // se for: a flash message é especifica para esse tipo de erro
    if ($e->errorInfo[1] == 1451) {
        $_SESSION['tipo_alerta'] = 'danger';
        $_SESSION['alerta_msg'] = 'Não é possível excluir esta vacina, pois existem registros de vacinação vinculados a ela.';
    } else {
        // se nao for: uma mensagem de erro generica
        $_SESSION['tipo_alerta'] = 'danger';
        $_SESSION['alerta_msg'] = 'Ocorreu um erro ao tentar excluir a vacina.';
    }
}

header('Location: /vacine_ai/views/gerenciar_vacinas_site.php');
exit;