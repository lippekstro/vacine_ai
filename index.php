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

        <nav class= "menu">
            <a href="#" class= "menu-link">Início</a>
            <a href="#" class= "menu-link">Recursos</a>
            <a href="#" class= "menu-link" >Sobre</a>
            <a href="#" class= "menu-link">Dúvidas</a>
            <a href="#" class= "menu-link">Contato</a>
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

<! ---------------------------------SESSAO DO CARROSSEL ------------------------------------ --!>


    </section>

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-autoplay="true">
            <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="vacine_ai/imgs/banner-1.png" class="d-block w-100 rounded-5" alt="...">
            </div>
            <div class="carousel-item">
            <img src="/vacine_ai/imgs/banner-2.png" class="d-block w-100 rounded-5" alt="...">
            </div>
            <div class="carousel-item">
        

            <img src="./imgs/banner-3.png" class="d-block w-100 rounded-5" alt="...">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div>
            <button class="btn-icon btn-sm carousel-control-play-pause" type="button" data-bs-target="#carouselExampleAutoplaying" aria-label="Pause" data-bs-pause-label="Pause" data-bs-play-label="Play">
                <span class="carousel-icon-pause" aria-hidden="true"></span>
                <span class="carousel-icon-play" aria-hidden="true"></span>
            </button>
            <button class="btn-icon btn-sm" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-icon-prev" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="btn-icon btn-sm" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-icon-next" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
        </div>

    </section>
</main>


<?php
require_once __DIR__ . "/templates/_rodape.php";
?>