<?php
require_once __DIR__ . "/templates/_cabecalho.php";
?>



<main class="mt-0">

    <!--falta fazer:
  1. link do java
  2. link dos icones caso formos usar google icone
  3. as bolinhas do banner
  4. alguma coisa que eu esqueci
-->


   



    <!--___________ primeira sessao________ -->
    <section class="mt-3">

        <!--_____________ coluna 1 ____________ -->
        <div class="info_1">

            <img class="imagem-principal" src="imgs/inicio.jpg" alt="">
            

        </div>




    </section>

    <!-- ---------------------------------SESSAO DO CARROSSEL ------------------------------------ -->
    <section class="container">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </section>
</main>


<?php
require_once __DIR__ . "/templates/_rodape.php";
?>