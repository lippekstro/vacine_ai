<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
?>

<main class="container">
    <div class="d-flex justify-content-center align-items center">
        <form action="/vacine_ai/controllers/criar_vacinas_controller.php" method="post">
            <div class="caixa-formulario">
                <div class="grupo">
                    <label for="nome">Nome da Vacina</label>
                    <input type="text" name="nome" id="nome">
                </div>

                <div class="grupo">
                    <label for="qtd_doses">Quantidade de Doses</label>
                    <input type="number" name="qtd_doses" id="qtd_doses">
                </div>

                <div class="grupo">
                    <label for="periodo">Periodo entre Doses</label>
                    <input type="number" name="periodo" id="periodo">
                </div>

                <div class="grupo">
                    <button type="submit" class="botao-cadastrar">Cadastrar</button>
                </div>
            </div>

        </form>
    </div>

</main>


<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>