<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
?>


<main class="login-page">

    <div class="login-layout">

        <!-- LADO ESQUERDO -->
        <section class="login-illustration">

            <div class="brand">
                <img src="/vacine_ai/imgs/logo2.png" alt="logo">

                <span class="brand-name">
                    Vacine<span>Ai</span>
                </span>
            </div>

            <img
                class="family-image"
                src="../imgs/familia-vacina.jpg">

            <h2>
                Cuidar da sua saúde
                <br>
                começa pela <span class="highlight">prevenção.</span>
            </h2>

            <p class="illustration-description">
            </p>

            <!-- BENEFÍCIOS -->
            <div class="benefits">

                <div class="benefit">
                    <img src="/vacine_ai/imgs/calendar_month.png" alt="logo">

                    <p>Organize<br>sua carteira</p>
                </div>

                <div class="benefit">
                    <img src="/vacine_ai/imgs/notifications_active.png" alt="logo">
                    <p>Receba<br>lembretes</p>
                </div>

                <div class="benefit">
                    <img src="/vacine_ai/imgs/groups.png" alt="logo">
                    <p>Para toda<br>a família</p>
                </div>

                <div class="benefit">
                    <img src="/vacine_ai/imgs/verified_user.png" alt="logo">
                    <p>Segurança<br>e privacidade</p>
                </div>

            </div>

        </section>

        <!-- LADO DIREITO: LOGIN -->
        <section class="login-card">

            <div class="login-icon">
                <img src="/vacine_ai/imgs/lock.png" alt="logo">
            </div>

            <h1>Bem-vindo(a)!</h1>

            <p class="login-subtitle">
                Faça login para acessar sua conta
            </p>

            <form
                action="/vacine_ai/controllers/login_controller.php"
                method="post"
                class="login-form">

                <!-- E-MAIL OU CPF -->
                <div class="form-group">

                    <label for="email">
                        E-mail
                    </label>

                    <div class="input-box">

                        <img src="/vacine_ai/imgs/person.png" alt="logo">

                        <input
                            type="text"
                            name="email"
                            id="email"
                            placeholder="Digite seu e-mail"
                            autocomplete="username"
                            required>

                    </div>

                </div>

                <!-- SENHA -->
                <div class="form-group">

                    <label for="senha">
                        Senha
                    </label>

                    <div class="input-box">

                        <img src="/vacine_ai/imgs/lock_preto.png" alt="logo">

                        <input
                            type="password"
                            name="senha"
                            id="senha"
                            placeholder="Digite sua senha"
                            autocomplete="current-password"
                            required>

                        <span
                            class="material-symbols-outlined toggle-password"
                            id="toggleSenha"
                            role="button"
                            tabindex="0"
                            aria-label="Mostrar senha"
                            aria-pressed="false">visibility</span>

                    </div>

                    <a href="#" class="forgot-password">
                        Esqueceu sua senha?
                    </a>

                </div>

                <!-- ENTRAR -->
                <button type="submit" class="btn-enter">

                    <img src="/vacine_ai/imgs/login.png" alt="logo">

                    Entrar

                </button>

            </form>

            <!-- SEPARADOR -->
            <div class="separator">
                <span>ou continuar com</span>
            </div>

            <!-- GOOGLE -->
            <button
                type="button"
                class="social-login google-login">

                <img
                    src="https://www.google.com/favicon.ico"
                    alt=""
                    width="24"
                    height="24">

                <span>Continuar com Google</span>

            </button>

            <!-- MICROSOFT -->
            <button
                type="button"
                class="social-login microsoft-login">

                <img
                    src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg"
                    alt=""
                    width="24"
                    height="24">

                <span>Continuar com Microsoft</span>

            </button>

            <!-- CRIAR CONTA -->
            <div class="create-account">

                <span>Não tem uma conta?</span>

                <a href="/vacine_ai/views/cadastro_usuario.php">Criar conta</a>

            </div>

        </section>

    </div>

</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const senha = document.getElementById("senha");
        const toggle = document.getElementById("toggleSenha");

        function alternarSenha() {
            const mostrar = senha.type === "password";

            senha.type = mostrar ? "text" : "password";

            toggle.textContent = mostrar ?
                "visibility_off" :
                "visibility";

            toggle.setAttribute(
                "aria-label",
                mostrar ? "Ocultar senha" : "Mostrar senha"
            );

            toggle.setAttribute("aria-pressed", String(mostrar));
        }

        toggle.addEventListener("click", alternarSenha);

        toggle.addEventListener("keydown", function(event) {
            if (event.key === "Enter" || event.key === " ") {
                event.preventDefault();
                alternarSenha();
            }
        });

    });
</script>

<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>