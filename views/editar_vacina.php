<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/vacinas.php";
require_once __DIR__ ."/../models/vacinacao.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$vacinas = Vacina::listar();
$id = (int)$_GET['id'];

$vacinacao = new Vacinacao($id);

?>

<main>
    <div class="centraliza">
        <form action="/vacine_ai/controllers/editar_vacina_controller.php" method="POST">
            <div class="caixa-formulario">
                <input type="hidden"
                name="id_vacinacao"
                value="<?= $vacinacao->getId_vacinacao() ?>">

                <h1>💉 Editar Vacina</h1>
                
                <div class="grupo">
                    <label for="vacina">Qual a vacina?</label>
                    <select name="vacina" id="vacina" required>
                        <option value="">Selecione uma vacina</option>
                        <?php foreach ($vacinas as $vac): ?>
                            <option value="<?= $vac['id_vacina'] ?>" <?= $vac['id_vacina']== $vacinacao->getId_vacina() ? "selected" : "" ?>>
                                <?= $vac['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grupo">
                    <label for="dose">Qual dose?</label>
                    <select name="dose" id="dose" required >
                        <option value="">Selecione uma dose</option>
                        <?php foreach ($vacinas as $vac): ?>
                            <?php if($vac['id_vacina']== $vacinacao->getId_vacina()): ?>
                                <?php for($i=1; $i<= $vac['qtd_doses'];$i++): ?>
                                    <option value="<?= $i ?>"  <?= $i == $vacinacao->getDose() ? "selected" : "" ?>>
                                        <?= $i  ?> dose
                                    </option>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
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
                        max="<?= date('Y-m-d') ?>"
                        value="<?= $vacinacao->getDt_ultima() ?>"
                        required>
                </div>

                <div class="grupo">
                    <label for="proxima_vacinacao">
                        Data da próxima vacinação
                    </label>

                    <input
                        type="date"
                        name="proxima_vacinacao"
                        id="proxima_vacinacao"
                        value="<?= $vacinacao->getDt_proxima() ?>">

                </div>

                <button type="submit" class="botao-cadastrar">
                    Editar vacina
                </button>

            </div>
        </form>
    </div>


</main>






<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>