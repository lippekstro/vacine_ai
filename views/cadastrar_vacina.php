<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
?>

<main>
    <form>
        <fieldset qualified>
            <legend>Cadastrar vacinas</legend>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Qual a vacina ?</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Selecione a vacina</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <div class="mb-3">
                    <label for="disabledSelect" class="form-label">Qual dose ?</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecione a vacina</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <legend>Data da aplicação</legend>
                <div class="mb-3">
                    <label for="data-vacina" type="date"></label>
                    <input class="data-vacina" type="date">
                </div>
                <legend>Data da próxima vacinação</legend>
                <div class="mb-3">
                    <label for="prox-vacina" type="date"></label>
                    <input class="prox-vacina" type="date">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </fieldset>
    </form>

</main>


<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>