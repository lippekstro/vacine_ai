<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
?>

<main>
    <form>
        <div class="caixa-formulario">

            <h1>💉 Cadastrar Vacina</h1>
            <p class="subtitulo">
                Registre a aplicação e acompanhe a próxima dose.
            </p>

            <form action="" method="POST">

                <div class="grupo">
                    <label for="vacina">Qual a vacina?</label>
                    <select name="vacina" id="vacina" required>
                        <option value="">Selecione uma vacina</option>
                        <option value="1">BCG</option>
                        <option value="2">Gripe</option>
                        <option value="3">Febre Amarela</option>
                    </select>
                </div>

                <div class="grupo">
                    <label for="dose">Qual dose?</label>
                    <select name="dose" id="dose" required>
                        <option value="">Selecione uma dose</option>
                        <option value="1">1º dose</option>
                        <option value="2">2º dose</option>
                        <option value="3">3º dose</option>

                    </select>
                </div>

                <div class="grupo">
                    <label for="data_aplicacao">
                        Data da aplicação
                    </label>
                    <input
                        type="date"
                        name="data_aplicacao"
                        id="data_aplicacao"
                        required>
                </div>

                <div class="grupo">
                    <label for="proxima_vacinacao">
                        Data da próxima vacinação
                    </label>
                    <input
                        type="date"
                        name="proxima_vacinacao"
                        id="proxima_vacinacao">
                </div>

                <button type="submit" class="botao-cadastrar">
                    Cadastrar vacina
                </button>

            </form>

        </div>
    </form>

</main>




<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>