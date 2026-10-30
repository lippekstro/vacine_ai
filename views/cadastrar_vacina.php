<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/vacinas.php";

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
                        disabled>
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

        let periodo = 0;

        // Seleção da vacina
        selectVacina.addEventListener('change', function() {

            const opcaoSelecionada = selectVacina.options[
                selectVacina.selectedIndex
            ];

            const quantidadeDoses = parseInt(
                opcaoSelecionada.dataset.doses,
                10
            );

            periodo = parseInt(
                opcaoSelecionada.dataset.periodo,
                10
            );

            // Limpa as opções anteriores
            selectDose.innerHTML = '';

            // Limpa as datas
            dataAplicacao.value = '';
            proximaVacinacao.value = '';
            proximaVacinacao.disabled = true;

            // Verifica se uma vacina foi selecionada
            if (!selectVacina.value || isNaN(quantidadeDoses)) {

                selectDose.disabled = true;

                selectDose.add(new Option(
                    'Selecione primeiro uma vacina',
                    ''
                ));

                return;
            }

            // Adiciona opção inicial
            selectDose.add(new Option('Selecione uma dose', ''));

            // Se tiver apenas uma dose
            if (quantidadeDoses === 1) {

                selectDose.add(new Option('Dose Única', 1));

            } else {

                // Cria as doses dinamicamente
                for (let i = 1; i <= quantidadeDoses; i++) {

                    selectDose.add(new Option(`${i}ª dose`, i));

                }

            }

            // Libera o campo
            selectDose.disabled = false;
        });


        // Seleção da data da aplicação
        dataAplicacao.addEventListener('change', function() {

            const dataSelecionada = dataAplicacao.value;

            if (!dataSelecionada) {

                proximaVacinacao.value = '';
                proximaVacinacao.disabled = true;

                return;
            }

            // Se não houver período, não existe sugestão
            if (isNaN(periodo) || periodo <= 0) {

                proximaVacinacao.value = '';
                proximaVacinacao.disabled = true;

                return;
            }

            const data = new Date(dataSelecionada + 'T12:00:00');

            // Soma o período em dias
            data.setDate(data.getDate() + periodo);

            const ano = data.getFullYear();
            const mes = String(data.getMonth() + 1).padStart(2, '0');
            const dia = String(data.getDate()).padStart(2, '0');

            const dataCalculada = `${ano}-${mes}-${dia}`;

            // Libera o campo e sugere a data
            proximaVacinacao.disabled = false;
            proximaVacinacao.value = dataCalculada;

        });

    });
</script>




<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>