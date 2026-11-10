<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/vacinas.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$id = $_GET['id'];
$vacina = new Vacina($id);

?>

<main class="container">
    <div class="d-flex justify-content-center align-items center">
        <form action="/vacine_ai/controllers/editar_vacina_admin_controller.php" method="post">

            <input type="hidden" name="id" value="<?= $vacina->getId() ?>">

            <div class="caixa-formulario">
                <div class="grupo">
                    <label for="nome">Nome da Vacina</label>
                    <input type="text" name="nome" id="nome" value="<?= $vacina->getNome() ?>">
                </div>

                <div class="grupo">
                    <label for="qtd_doses">Quantidade de Doses</label>
                    <input type="number" name="qtd_doses" id="qtd_doses" value="<?= $vacina->getQtd() ?>">
                </div>

                <div class="grupo">
                    <label for="periodo">Periodo entre Doses</label>
                    <input type="number" name="periodo" id="periodo" value="<?= $vacina->getPeriodo() ?>">
                </div>

                <div class="grupo">
                    <button type="submit" class="botao-cadastrar mb-3">Atualizar</button>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="/vacine_ai/views/gerenciar_vacinas_site.php" class="btn btn-danger">Cancelar</a>
                </div>

            </div>

        </form>
    </div>

</main>


<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>