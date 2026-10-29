<?php
require_once __DIR__ . "/../templates/_cabecalho.php";

// Dados fictícios para demonstração do front-end.
$usuario = [
    "nome" => "Maria Oliveira Santos",
    "data_nascimento" => "1998-08-15",
    "genero" => "Feminino",
    "email" => "maria.oliveira@email.com",
    "telefone" => "(98) 99999-9999",
    "cpf" => "123.456.789-00",
    "foto" => "https://picsum.photos/200",
    "administrador" => true
];

// Formata a data para exibição.
$dataNascimento = date(
    "d/m/Y",
    strtotime($usuario["data_nascimento"])
);
?>

<main class="container py-5">

    <!-- Cabeçalho do perfil -->
    <section class="text-center mb-4">

        <img
            src="<?= htmlspecialchars($usuario['foto']) ?>"
            alt="Foto de perfil"
            class="rounded-circle img-thumbnail mb-3"
            width="150"
            height="150"
            style="object-fit: cover;">

        <h1 class="fw-bold text-success">
            Meu perfil
        </h1>

        <p class="text-white">
            Confira seus dados pessoais e gerencie suas vacinas.
        </p>

    </section>

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9">

            <!-- Dados pessoais -->
            <section class="card shadow-sm border-0 mb-4">

                <div class="card-body p-4">

                    <h2 class="h4 fw-bold text-success mb-4">
                        <i class="bi bi-person-circle me-2"></i>
                        Dados pessoais
                    </h2>

                    <div class="row g-3">

                        <!-- Nome -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Nome completo
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($usuario['nome']) ?>"
                                readonly>
                        </div>

                        <!-- Data de nascimento -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold">
                                Data de nascimento
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($dataNascimento) ?>"
                                readonly>
                        </div>

                        <!-- Gênero -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold">
                                Gênero
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($usuario['genero']) ?>"
                                readonly>
                        </div>

                        <!-- E-mail -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                E-mail
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                value="<?= htmlspecialchars($usuario['email']) ?>"
                                readonly>
                        </div>

                        <!-- Telefone -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold">
                                Telefone
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($usuario['telefone']) ?>"
                                readonly>
                        </div>

                        <!-- CPF -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold">
                                CPF
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($usuario['cpf']) ?>"
                                readonly>
                        </div>

                    </div>

                    <!-- Editar perfil -->
                    <div class="d-grid mt-4">

                        <a
                            href="/vacine_ai/views/editar_perfil.php"
                            class="btn btn-success btn-lg">
                            <i class="bi bi-pencil-square me-2"></i>
                            Editar perfil
                        </a>

                    </div>

                </div>

            </section>

            <!-- Gerenciamento das vacinas do usuário -->
            <section class="card shadow-sm border-0 mb-4">

                <div class="card-body p-4">

                    <h2 class="h4 fw-bold text-success mb-3">
                        <i class="bi bi-capsule me-2"></i>
                        Minhas vacinas
                    </h2>

                    <p class="text-secondary">
                        Consulte suas vacinas registradas, acompanhe as
                        doses aplicadas e confira as próximas datas
                        de vacinação.
                    </p>

                    <div class="d-grid">

                        <a
                            href="/vacine_ai/views/minhas_vacinas.php"
                            class="btn btn-outline-success btn-lg">
                            <i class="bi bi-clipboard2-pulse me-2"></i>
                            Gerenciar minhas vacinas
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                    </div>

                </div>

            </section>

            <!-- Gerenciamento administrativo -->
            <?php if ($usuario['administrador']): ?>

                <section class="card shadow-sm border-0 mb-4">

                    <div class="card-body p-4">

                        <h2 class="h4 fw-bold text-success mb-3">
                            <i class="bi bi-gear-fill me-2"></i>
                            Gerenciamento de vacinas
                        </h2>

                        <span class="badge text-bg-warning mb-3">
                            Área administrativa
                        </span>

                        <p class="text-secondary">
                            Gerencie as vacinas disponíveis no site,
                            cadastre novas vacinas e atualize as
                            informações do catálogo.
                        </p>

                        <div class="d-grid">

                            <a
                                href="/vacine_ai/views/gerenciar_vacinas.php"
                                class="btn btn-outline-warning btn-lg">
                                <i class="bi bi-gear me-2"></i>
                                Gerenciar vacinas do site
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>

                        </div>

                    </div>

                </section>

            <?php endif; ?>

        </div>

    </div>

</main>

<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>