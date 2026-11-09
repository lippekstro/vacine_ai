<?php
require_once __DIR__ . "/templates/_cabecalho.php";
?>



<main class="mt-0">




   



    <!--___________ primeira sessao________ -->
<section class="hero-container">
        <!-- Lado Esquerdo: Texto (Sem Botões) -->
        <div class="text-section">
            <h1>Cuidar da sua saúde<br>começa pela <span>prevenção.</span></h1>
            <p>O VacineAi organiza sua carteira de vacinação, lembra você das próximas doses e protege o que mais importa: você e sua família.</p>
        </div>

        <!-- Lado Direito: Estrutura do Carrossel -->
        <div class="carousel-section">
            
            <!-- Card 1: Próximas Doses -->
            <div class="carousel-card">
                <div class="carousel-header">
                    <h3>Próximas doses</h3>
                    <a href="#">Ver todas</a>
                </div>
                <!-- Estrutura dos itens do carrossel/lista -->
                <div class="card-dose-item">
                    <!-- Espaço para ícone -->
                    <div>
                        <h4>Hepatite B - 3ª dose</h4>
                        <small>10/09/2026</small>
                    </div>
                </div>
                <div class="card-dose-item">
                    <!-- Espaço para ícone -->
                    <div>
                        <h4>Febre Amarela - Reforço</h4>
                        <small>20/10/2026</small>
                    </div>
                </div>
            </div>

            <!-- Card 2: Banner Secundário do Carrossel -->
            <div class="carousel-card banner-card">
                <!-- Espaço para imagem do celular -->
                <div>
                    <h3 style="color: #0c2b3e; margin-bottom: 5px;">Nunca mais esqueça uma dose!</h3>
                    <p style="font-size: 10px; color: #334e5e;">Ative seus lembretes e fique sempre protegido.</p>
                </div>
            </div>

        </div>
    </section>
<div class="hero-container">
        <!-- Lado Esquerdo: Texto (Sem Botões) -->
        <div class="text-section">
            <h1>Cuidar da sua saúde<br>começa pela <span>prevenção.</span></h1>
            <p>O VacineAi organiza sua carteira de vacinação, lembra você das próximas doses e protege o que mais importa: você e sua família.</p>
        </div>

        <!-- Lado Direito: Estrutura do Carrossel -->
        <div class="carousel-section">
            
            <!-- Card 1: Próximas Doses -->
            <div class="carousel-card">
                <div class="carousel-header">
                    <h3>Próximas doses</h3>
                    <a href="#">Ver todas</a>
                </div>
                <!-- Estrutura dos itens do carrossel/lista -->
                <div class="card-dose-item">
                    <!-- Espaço para ícone -->
                    <div>
                        <h4>Hepatite B - 3ª dose</h4>
                        <small>10/09/2026</small>
                    </div>
                </div>
                <div class="card-dose-item">
                    <!-- Espaço para ícone -->
                    <div>
                        <h4>Febre Amarela - Reforço</h4>
                        <small>20/10/2026</small>
                    </div>
                </div>
            </div>

            <!-- Card 2: Banner Secundário do Carrossel -->
            <div class="carousel-card banner-card">
                <!-- Espaço para imagem do celular -->
                <div>
                    <h3 style="font-size: 17px; color: #0c2b3e; margin-bottom: 5px;">Nunca mais esqueça uma dose!</h3>
                    <p style="font-size: 10px; color: #334e5e;">Ative seus lembretes e fique sempre protegido.</p>
                </div>
            </div>

        </div>
    </div>

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


<?php
require_once __DIR__ . "/templates/_rodape.php";
?>