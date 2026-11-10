<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/vacinas.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$vacinas = Vacina::listar();

?>

<main>
    <div class="centraliza">
        <form action="/vacine_ai/controllers/add_vacina_controller.php" method="POST">
            <div class="caixa-formulario">

                <h1>💉 Cadastrar Vacina</h1>
                <p class="subtitulo">
                    Registre a aplicação e acompanhe a próxima dose.
                </p>



                <div class="grupo">
                    <label for="vacina">Qual a vacina?</label>
                    <select name="vacina" id="vacina" required>
                        <option value="">Selecione uma vacina</option>
                        <?php foreach ($vacinas as $vac): ?>
                            <option
                                value="<?= $vac['id_vacina'] ?>"
                                data-doses="<?= (int) $vac['qtd_doses'] ?>"
                                data-periodo="<?= (int) $vac['periodo'] ?>">
                                <?= $vac['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grupo">
                    <label for="dose">Qual dose?</label>
                    <select name="dose" id="dose" required disabled>
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
                        readonly>
                </div>

                <button type="submit" class="botao-cadastrar">
                    Cadastrar vacina
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

        // Guarda os dados da vacina selecionada
        let periodo = 0;
        let quantidadeDoses = 0;

        function carregarDoses() {

            const opcao = selectVacina.options[selectVacina.selectedIndex];

            quantidadeDoses = parseInt(opcao.dataset.doses, 10);
            periodo = parseInt(opcao.dataset.periodo, 10);

            selectDose.innerHTML = '';

            dataAplicacao.value = '';
            proximaVacinacao.value = '';

            proximaVacinacao.readOnly = true;

            if (!selectVacina.value || isNaN(quantidadeDoses)) {

                selectDose.disabled = true;
                selectDose.add(new Option('Selecione primeiro uma vacina', ''));

                return;
            }

            selectDose.add(new Option('Selecione uma dose', ''));

            for (let i = 1; i <= quantidadeDoses; i++) {

                const nome = quantidadeDoses === 1 ?
                    'Dose Única' :
                    `${i}ª dose`;

                selectDose.add(new Option(nome, i));
            }

            selectDose.disabled = false;
        }


        function calcularProximaVacinacao() {

            const dataSelecionada = dataAplicacao.value;
            const doseSelecionada = parseInt(selectDose.value, 10);

            // Limpa a data inicialmente
            proximaVacinacao.value = '';

            // Verifica se os campos foram preenchidos
            if (!dataSelecionada || isNaN(doseSelecionada)) {

                proximaVacinacao.readOnly = true;
                return;
            }

            // Verifica se é a última dose
            if (doseSelecionada >= quantidadeDoses) {

                proximaVacinacao.readOnly = true;
                return;
            }

            // Verifica se existe período cadastrado
            if (isNaN(periodo) || periodo <= 0) {

                proximaVacinacao.readOnly = true;
                return;
            }

            // Calcula a próxima vacinação
            const data = new Date(dataSelecionada + 'T12:00:00');

            data.setDate(data.getDate() + periodo);

            const ano = data.getFullYear();
            const mes = String(data.getMonth() + 1).padStart(2, '0');
            const dia = String(data.getDate()).padStart(2, '0');

            proximaVacinacao.value = `${ano}-${mes}-${dia}`;

            proximaVacinacao.readOnly = true;
        }


        // Quando selecionar uma vacina
        selectVacina.addEventListener('change', carregarDoses);

        // Quando selecionar uma dose
        selectDose.addEventListener('change', calcularProximaVacinacao);

        // Quando selecionar a data de aplicação
        dataAplicacao.addEventListener('change', calcularProximaVacinacao);

    });
</script>




<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>