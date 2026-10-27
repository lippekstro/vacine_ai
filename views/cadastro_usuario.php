<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
?>

<main>

    <div class="container m-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow border-0">
                    <div class="card-body p-4 p-md-5">

                        <h2 class="text-center mb-4">Criar conta</h2>

                        <form>
                            <div class="mb-3">
                                <label for="nome" class="form-label">
                                    Nome completo
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nome"
                                    placeholder="Digite seu nome"
                                    autofocus
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    E-mail
                                </label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="nome@exemplo.com"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="dataNascimento" class="form-label">
                                    Data de nascimento
                                </label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="dataNascimento"
                                    placeholder="Digite sua data de nascimento"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="cpf" class="form-label">
                                    CPF
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="cpf"
                                    placeholder="123.456.789-00"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="genero" class="form-label">
                                    Gênero
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="genero"
                                    placeholder=""
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="telefone" class="form-label">
                                    Telefone
                                </label>
                                <input
                                    type="tel"
                                    class="form-control"
                                    id="telefone"
                                    placeholder="(00) 00000-0000"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">
                                    Foto de perfil
                                </label>
                                <input
                                    type="file"
                                    class="form-control"
                                    id="foto"
                                    placeholder="Selecione uma imagem"
                                    required>
                            </div>


                            <div class="mb-3">
                                <label for="senha" class="form-label">
                                    Senha
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="senha"
                                    placeholder="Digite sua senha"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="confirmarSenha" class="form-label">
                                    Confirmar senha
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="confirmarSenha"
                                    placeholder="Confirme sua senha"
                                    required>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100">
                                Cadastrar
                            </button>
                        </form>

                        <p class="text-center mt-4 mb-0">
                            Já possui uma conta?
                            <a href="#" class="text-decoration-none">
                                Entrar
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>