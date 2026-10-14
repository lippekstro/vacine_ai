<?php
require_once __DIR__ . "/templates/_cabecalho.php";
?>



<main>

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

        <nav class="menu">
            <a href="#" class="menu-link">Início</a>
            <a href="#" class="menu-link">Recursos</a>
            <a href="#" class="menu-link">Sobre</a>
            <a href="#" class="menu-link">Dúvidas</a>
            <a href="#" class="menu-link">Contato</a>
        </nav>

        <div class="botoes-topo">
            <a href="#" class="botoes">Login</a>
            <a href="#" class="botoes">Criar Conta</a>

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
                <h5> Segurança e privacidade </h5>

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

    <!-- ---------------------------------SESSAO DO CARROSSEL ------------------------------------ -->

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/vacine_ai/imgs/banner-1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/vacine_ai/imgs/banner-2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/vacine_ai/imgs/banner-3.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    </section>
</main>


<?php
require_once __DIR__ . "/templates/_rodape.php";
?>