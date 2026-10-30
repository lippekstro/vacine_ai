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
                            <option value="<?= $vac['id_vacina'] ?>" data-doses="<?= (int) $vac['qtd_doses'] ?>"><?= $vac['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grupo">
                    <label for="dose">Qual dose?</label>
                    <select name="dose" id="dose" required disabled>
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

            </div>
        </form>
    </div>


</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectVacina = document.getElementById('vacina');
        const selectDose = document.getElementById('dose');

        selectVacina.addEventListener('change', function() {
            const opcaoSelecionada = selectVacina.options[
                selectVacina.selectedIndex
            ];

            const quantidadeDoses = parseInt(
                opcaoSelecionada.dataset.doses,
                10
            );

            // Limpa as opções anteriores
            selectDose.innerHTML = '';

            // Se nenhuma vacina estiver selecionada
            if (!selectVacina.value || isNaN(quantidadeDoses)) {
                selectDose.disabled = true;
                selectDose.required = true;

                selectDose.add(new Option(
                    'Selecione primeiro uma vacina',
                    ''
                ));

                return;
            }

            // Adiciona a opção inicial
            selectDose.add(new Option('Selecione uma dose', ''));

            // Cria as doses conforme a quantidade da vacina
            for (let i = 1; i <= quantidadeDoses; i++) {
                selectDose.add(new Option(`${i}ª dose`, i));
            }

            // Libera o select
            selectDose.disabled = false;
        });
    });
</script>




<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>