<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/vacinas.php";

$vacinas = Vacina::listar();
?>

<main class="container py-5">

    <!-- Cabeçalho -->
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h1 class="fw-bold text-success">
                <i class="bi bi-capsule me-2"></i>
                Gerenciamento de vacinas
            </h1>

            <p class="text-white mb-0">
                Consulte, edite e gerencie as vacinas disponíveis no site.
            </p>
        </div>

        <!-- Cadastrar nova vacina -->
        <a
            href="/vacine_ai/views/cadastro_vacina_admin.php"
            class="btn btn-success btn-lg">
            <i class="bi bi-plus-circle me-2"></i>
            Cadastrar nova vacina
        </a>

    </div>

    <!-- Listagem -->
    <section class="card shadow-sm border-0">

        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row
                        justify-content-between align-items-md-center gap-2 mb-4">

                <h2 class="h4 fw-bold mb-0">
                    Vacinas cadastradas
                </h2>

                <span class="badge text-bg-success fs-6">
                    <?= count($vacinas) ?> vacinas
                </span>

            </div>

            <!-- Tabela responsiva -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-success">
                        <tr>
                            <!-- <th scope="col">ID</th> -->
                            <th scope="col">Nome da vacina</th>
                            <th scope="col">Quantidade de doses</th>
                            <!-- <th scope="col">Intervalo</th> -->
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($vacinas as $vacina): ?>

                            <tr>

                               

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($vacina['nome']) ?>
                                </td>

                                <td>
                                    <span class="badge text-bg-light border">
                                        <?= (int) $vacina['qtd_doses'] ?>
                                        <?= (int) $vacina['qtd_doses'] === 1
                                            ? 'dose'
                                            : 'doses' ?>
                                    </span>
                                </td>

                              

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- Editar -->
                                        <a
                                            href="/vacine_ai/views/editar_vacina.php?id=<?= (int) $vacina['id_vacina'] ?>"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                            Editar
                                        </a>

                                        <!-- Excluir: apenas visual -->
                                        <a
                                            href="#"
                                            class="btn btn-outline-danger btn-sm"
                                            aria-disabled="true"
                                            onclick="return false;">
                                            <i class="bi bi-trash"></i>
                                            Excluir
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <div class="text-secondary small mt-3">
                Exibindo <?= count($vacinas) ?> vacinas cadastradas.
            </div>

        </div>

    </section>

</main>

<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>
```