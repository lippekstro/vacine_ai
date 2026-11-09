<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/vacinas.php";
require_once __DIR__ . "/../models/vacinacao.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$vacinas = Vacina::listar();

$id = (int) $_GET['id'];

$vacinacao = new Vacinacao($id);
?>

<main>
    <div class="centraliza">
        <form action="/vacine_ai/controllers/editar_vacina_controller.php" method="POST">

            <div class="caixa-formulario">

                <input
                    type="hidden"
                    name="id_vacinacao"
                    value="<?= $vacinacao->getId_vacinacao() ?>">

                <h1>💉 Editar Vacina</h1>

                <p class="subtitulo">
                    Atualize os dados da vacinação.
                </p>

                <div class="grupo">
                    <label for="vacina">Qual a vacina?</label>

                    <select name="vacina" id="vacina" required>

                        <option value="">Selecione uma vacina</option>

                        <?php foreach ($vacinas as $vac): ?>

                            <option
                                value="<?= $vac['id_vacina'] ?>"
                                data-doses="<?= (int) $vac['qtd_doses'] ?>"
                                data-periodo="<?= (int) $vac['periodo'] ?>"
                                <?= $vac['id_vacina'] == $vacinacao->getId_vacina() ? "selected" : "" ?>>

                                <?= $vac['nome'] ?>

                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="grupo">
                    <label for="dose">Qual dose?</label>

                    <select
                        name="dose"
                        id="dose"
                        required
                        disabled>

                        <option value="">Selecione uma dose</option>

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
                        value="<?= $vacinacao->getDt_proxima() ?>"
                        disabled>
                </div>

                <button type="submit" class="botao-cadastrar">
                    Editar vacina
                </button>

            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const selectVacina = document.getElementById('vacina');
        const selectDose = document.getElementById('dose');

        const dataAplicacao = document.getElementById('data_aplicacao');
        const proximaVacinacao = document.getElementById('proxima_vacinacao');

        const doseAtual = <?= (int) $vacinacao->getDose() ?>;

        let periodo = 0;

        // Carrega as doses da vacina selecionada
        function carregarDoses(manterDose = false) {

            const opcaoSelecionada =
                selectVacina.options[selectVacina.selectedIndex];

            const quantidadeDoses = parseInt(
                opcaoSelecionada.dataset.doses,
                10
            );

            periodo = parseInt(
                opcaoSelecionada.dataset.periodo,
                10
            );

            const doseSelecionada = manterDose ? doseAtual : '';

            selectDose.innerHTML = '';

            if (!selectVacina.value || isNaN(quantidadeDoses)) {

                selectDose.disabled = true;

                selectDose.add(
                    new Option('Selecione primeiro uma vacina', '')
                );

                return;
            }

            selectDose.add(
                new Option('Selecione uma dose', '')
            );

            if (quantidadeDoses === 1) {

                const opcao = new Option('Dose Única', 1);

                if (doseSelecionada === 1) {
                    opcao.selected = true;
                }

                selectDose.add(opcao);

            } else {

                for (let i = 1; i <= quantidadeDoses; i++) {

                    const opcao = new Option(`${i}ª dose`, i);

                    if (i === doseSelecionada) {
                        opcao.selected = true;
                    }

                    selectDose.add(opcao);
                }
            }

            selectDose.disabled = false;
        }


        // Calcula a próxima vacinação

        function calcularProximaVacinacao() {

            const dataSelecionada = dataAplicacao.value;

            const opcaoSelecionada =
                selectVacina.options[selectVacina.selectedIndex];

            const quantidadeDoses = parseInt(
                opcaoSelecionada.dataset.doses,
                10
            );

            const doseSelecionada = parseInt(
                selectDose.value,
                10
            );

            // Limpa a data se não houver aplicação ou dose selecionada
            if (!dataSelecionada || isNaN(doseSelecionada)) {

                proximaVacinacao.value = '';
                proximaVacinacao.readOnly = true;

                return;
            }

            // Verifica se é a última dose
            if (doseSelecionada >= quantidadeDoses) {

                proximaVacinacao.value = '';
                proximaVacinacao.readOnly = true;

                return;
            }

            // Verifica se existe período para calcular
            if (isNaN(periodo) || periodo <= 0) {

                proximaVacinacao.value = '';
                proximaVacinacao.readOnly = true;

                return;
            }

            const data = new Date(dataSelecionada + 'T12:00:00');

            data.setDate(data.getDate() + periodo);

            const ano = data.getFullYear();

            const mes = String(
                data.getMonth() + 1
            ).padStart(2, '0');

            const dia = String(
                data.getDate()
            ).padStart(2, '0');

            proximaVacinacao.value = `${ano}-${mes}-${dia}`;

            proximaVacinacao.readOnly = false;
        }



        // Inicialização da página
        carregarDoses(true);

        // Verifica se a dose atual permite uma próxima vacinação
        if (parseInt(selectDose.value, 10) >=
            parseInt(
                selectVacina.options[selectVacina.selectedIndex].dataset.doses,
                10
            )) {

            proximaVacinacao.value = '';
            proximaVacinacao.readOnly = true;

        }

        // Quando trocar a vacina
        selectVacina.addEventListener('change', function() {

            carregarDoses(false);

            dataAplicacao.value = '';

            proximaVacinacao.value = '';
            proximaVacinacao.disabled = true;

        });


        // Quando trocar a data da aplicação
        dataAplicacao.addEventListener('change', function() {

            calcularProximaVacinacao();

        });

        selectDose.addEventListener('change', function() {

            calcularProximaVacinacao();

        });

    });
</script>

<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>