<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/usuario.php";

if (!Autenticacao::isLogado()) {
    header('Location: /vacine_ai/views/login.php');
    exit();
}

$usuario = new Usuario($_SESSION['id_usuario']);

?>

<main class="container">

    <div class="m-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow border-0">
                    <div class="card-body p-8 p-md-5">

                        <h2 class="criar-conta">Editar Perfil</h2>

                        <form action="/vacine_ai/controllers/usuario_edt_controller.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nome" class="form-label">
                                    Nome completo
                                </label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome" value="<?= $usuario->getNome() ?>" autofocus required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    E-mail
                                </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="nome@exemplo.com" value="<?= $usuario->getEmail() ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="dataNascimento" class="form-label">
                                    Data de nascimento
                                </label>
                                <input type="date" class="form-control" name="nascimento" id="dataNascimento" max="<?= date('Y-m-d') ?>" placeholder="Digite sua data de nascimento" value="<?= $usuario->getNascimento() ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="cpf" class="form-label">
                                    CPF
                                </label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="123.456.789-00" value="<?= $usuario->getCpf() ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="genero" class="form-label">
                                    Gênero
                                </label>
                                <input type="text" class="form-control" name="genero" id="genero" placeholder="" value="<?= $usuario->getGenero() ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefone" class="form-label">
                                    Telefone
                                </label>
                                <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="(00) 00000-0000" value="<?= $usuario->getTelefone() ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">
                                    Foto de perfil
                                </label>
                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" placeholder="Selecione uma imagem" required>
                            </div>

                            <button class="btn-enter btn btn-secondary w-100" type="submit">
                                Atualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>