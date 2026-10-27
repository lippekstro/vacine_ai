<?php
require_once __DIR__ . "/templates/_cabecalho.php";
?>



<main>
<!--uma pequena alteração-->
<!--falta fazer:
  1. link do java
  2. link dos icones caso formos usar google icone
  3. as bolinhas do banner
  4. alguma coisa que eu esqueci
-->


    <header>

        <!-- ____________ TOPO ___________ -->
        <div class="logo">
            <img src="imagens/logo.png">
            <h2>Vacine<span>Ai</span></h2>
        </div>

        <nav>
            <a href="#">Início</a>
            <a href="#">Recursos</a>
            <a href="#">Sobre</a>
            <a href="#">Dúvidas</a>
            <a href="#">Contato</a>
        </nav>

        <div class="botoes-topo">
            <button class="entrar">Entrar</button>
            <button class="criar">Criar Conta</button>
        </div>

    </header>



    <!--___________ primeira sessao________ -->
    <section>

        <!--_____________ coluna 1 ____________ -->
        <div class="info_1">
            <h1>
                Cuidar da sua saúde começa pela
                <span>prevenção.</span>
            </h1>

            <p>
                O VacineAi organiza sua carteira de vacinação,
                lembra das próximas doses e protege você e sua família.
            </p>


            <!-- ______________ coluna 2 (CENTRO) _________________-->
            <div class="img_central">
                <img src="colocar_ainda.png">
                <!-- icone 1 (calendario)  -->
                <img src="colocar_ainda.png">
                <!-- icone 2 (sino)-->
                <img src="colocar_ainda.png">
                <!-- icone 3 (familia)-->
                <img src="colocar_ainda.png">
                <!-- icone 4 (escudo de segurança) -->
                <img src="colocar_ainda.png">

                <!-- txt 1 -->
                <h5> Organize sua carteira</h5>
                <!-- txt 2 -->
                <h5> Receba lembretes</h5>
                <!-- txt 3-->
                <h5> Para toda a família </h5>
                <!-- txt 4 -->
                <h5> sSegurança e privacidade </h5>

            </div>


            <!-- ______________ coluna 3 ___________ -->
            <div class="card-vacinas">

                <h3>Próximas doses</h3>

                <div class="vacina">
                    <p>Hepatite B</p>
                    <span>7 dias</span>
                </div>

                <div class="vacina">
                    <p>Febre Amarela</p>
                    <span>37 dias</span>
                </div>

                <div class="vacina">
                    <p>HPV</p>
                    <span>63 dias</span>
                </div>

            </div>

    </section>

    <!-- sessao 2  -->
    <section class="img_banner">
        <!-- imagem 1 -->
        <img src="colocar_ainda.png">
        <!-- imagem 2 -->
        <img src="colocar_ainda.png">
        <!-- imagem 3-->
        <img src="colocar_ainda.png">

        <!-- ta faltando as bolinhas de transicao que fica em baixo do banner.. to em duvida se é um forms.. depois eu coloco-->
    </section>
</main>


<?php
require_once __DIR__ . "/templates/_rodape.php";
?>