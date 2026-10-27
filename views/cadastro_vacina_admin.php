<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
?>

<main class="container">
    <form action="/vacine_ai/controllers/criar_vacinas_controller.php" method="post">
        <label for="nome">Nome da Vacina</label>
        <input type="text" name="nome" id="nome">
        <label for="qtd_doses">Quantidade de Doses</label>
        <input type="number" name="qtd_doses" id="qtd_doses">

        <button type="submit">Cadastrar</button>
    </form>
</main>


<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>