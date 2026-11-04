

<?php
require_once __DIR__ . "/templates/_cabecalho.php";
?>

<main class="mt-0">



    <!--___________ primeira sessao________ -->
<section class="hero-container">
    <!-- caixa 1-->
    <div class="info1">
        <h5 style="font-weight: bold; padding-top: 10px;">   Cuidar da sua saúde<br>começa pela <span>prevenção.</span></h5>
        <p>O VacineAi organiza sua carteira de vacinação, lembra você das próximas doses e protege o que mais importa: você e sua família.</p>
       
    </div>

    <!-- caixa 2-->
    <!--<div class="imagem-principal">-->
        <img class= "imagem-principal-img" src="/vacine_ai/imgs/familia.png" alt="">
    </div>

    <!-- caixa 3-->
    <div class="vacinas">
    <!-- caixa 3.1-->
        <div class="info2">
            <div class="info2-titulo">
            <!--texto de cima -->  
            <h6 style="font-weight: bold; padding-top: 10px;"> Próximas doses</h5>
            <a href="#">Ver todas</a>
            </div>
            
          <!-- proximas doses --> 
            <!-- estrutura de repeticao de php mostrar as vacinas do usuario pendentes ou proximas doses? --> 
            <!--<div    class="vacinas-pendentes">  
                  colocar icone generico que aparecerá automaticamente
                <img src="imgs/icone-vacina.png" alt="">
                  trazer do banco de dados 
                   aqui pode ser br?
                <p>Hepatite B - 3° dose <br> 24/11/2026  </p> 
                  faltam quantos dias
                  <div class="info2-dias">
                    <p>Faltam 3 dias</p>
                  </div>
            </div> -->




            
            <table class="tabela-doses">
                <tr>
                    <td rowspan="2" class="icone">💉</td>

                    <td class="doses-vacinas">
                        <p>Hepatite B - 3ª dose</p>
                    </td>

                    <td rowspan="2" class="dias">
                        Faltam 3 dias
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>24/11/2026</p>
                    </td>
                </tr>
            </table>



        
  
            

        </div>


    <!-- caixa 3.2-->
        <div class="alarme">
            <div alarme-icone>
            <img src="/vacine_ai/imgs/telefone.png" alt="">
            </div >
            <div class="alarme-info">
                <p class="txt-subtitulo" "> Suas Vacinas na palma de sua mão!</p>
                <p class="txt-titulo">Nunca mais esqueça        suas vacinas!</p>
                <!--<p class="txt-subtitulo">  Ative seus lembretes e fique <br> sempre protegido.</p> -->
            </div>
        </div>
    </div>
</section>

  











    <!-- ---------------------------------SESSAO DO CARROSSEL ------------------------------------ -->
    <section class="container">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- -------- img 01------- -->
                <div class="carousel-item active">
                    <img src="/vacine_ai/imgs/banner-6.jpg" class="d-block w-100" alt="...">
                </div>

                <!-- -------- img 02------- -->
                <div class="carousel-item">
                    <img src="/vacine_ai/imgs/banner-7.jpg" class="d-block w-100" alt="...">
                </div>

                <!-- -------- img 03------- -->
                <div class="carousel-item">
                    <img src="/vacine_ai/imgs/banner-8.jpg" class="d-block w-100" alt="...">
                </div>

                <!-- -------- img 04------- -->
                <div class="carousel-item">
                    <img src="/vacine_ai/imgs/banner-9.jpg" class="d-block w-100" alt="...">
                </div>

                <!-- -------- img 05------- -->
                <div class="carousel-item">
                    <img src="/vacine_ai/imgs/banner-10.jpg" class="d-block w-100" alt="...">
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
       

    </body>

<?php
require_once __DIR__ . "/templates/_rodape.php";
?>






