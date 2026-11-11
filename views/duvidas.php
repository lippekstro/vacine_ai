<?php
require_once __DIR__ . "/../templates/_cabecalho.php";



?>


    <!-- CONTEÚDO PRINCIPAL -->
    <main>

        <!-- HERO -->
        <section class="mt-3">

            <div class="hero-texto">

                <span class="etiqueta">DÚVIDAS</span>

                <h1>
                    Tem alguma dúvida?
                    <span>Estamos aqui para ajudar.</span>
                </h1>

                <p>
                    Encontre respostas para as perguntas
                    mais frequentes sobre o VacineAí.
                </p>

            </div>

        </section>


        <!-- PESQUISA -->
        <section class="pesquisa">

            <input
                type="text"
                id="buscarDuvida"
                placeholder="Digite sua dúvida..."
            >

            <button type="button">⌕</button>

        </section>


        <!-- PERGUNTAS FREQUENTES -->
        <section class="faq">

            <div class="titulo-secao">
                <h2>Perguntas frequentes</h2>
                <p>
                    Confira algumas respostas que podem ajudar você.
                </p>
            </div>


            <div class="faq-container">

                <div class="faq-item">

                    <button class="pergunta">
                        <span>O que é o VacineAí?</span>
                        <span class="seta">+</span>
                    </button>

                    <div class="resposta">
                        <p>
                            O VacineAí é um sistema digital que ajuda
                            você a cadastrar, organizar e acompanhar
                            as vacinas da sua família.
                        </p>
                    </div>

                </div>


                <div class="faq-item">

                    <button class="pergunta">
                        <span>Como faço para cadastrar minhas vacinas?</span>
                        <span class="seta">+</span>
                    </button>

                    <div class="resposta">
                        <p>
                            Acesse sua conta, entre na área
                            Minhas Vacinas e informe os dados
                            da dose recebida.
                        </p>
                    </div>

                </div>


                <div class="faq-item">

                    <button class="pergunta">
                        <span>O VacineAí envia lembretes das próximas doses?</span>
                        <span class="seta">+</span>
                    </button>

                    <div class="resposta">
                        <p>
                            O sistema ajuda você a acompanhar
                            as próximas doses e identificar
                            quais vacinas precisam de atenção.
                        </p>
                    </div>

                </div>


                <div class="faq-item">

                    <button class="pergunta">
                        <span>Posso cadastrar vacinas de toda a família?</span>
                        <span class="seta">+</span>
                    </button>

                    <div class="resposta">
                        <p>
                            O cadastro permite organizar as informações
                            de vacinação conforme os perfis
                            disponibilizados pelo sistema.
                        </p>
                    </div>

                </div>


                <div class="faq-item">

                    <button class="pergunta">
                        <span>Meus dados ficam protegidos?</span>
                        <span class="seta">+</span>
                    </button>

                    <div class="resposta">
                        <p>
                            O VacineAí busca tratar as informações
                            dos usuários com responsabilidade,
                            respeitando a privacidade e os cuidados
                            necessários com os dados pessoais.
                        </p>
                    </div>

                </div>


                <div class="faq-item">

                    <button class="pergunta">
                        <span>O VacineAí substitui a carteira de vacinação?</span>
                        <span class="seta">+</span>
                    </button>

                    <div class="resposta">
                        <p>
                            Não. O VacineAí é uma ferramenta de
                            organização e acompanhamento.
                            A carteira de vacinação oficial
                            continua sendo importante.
                        </p>
                    </div>

                </div>

            </div>

            <p class="sem-resultado" id="semResultado">
                Nenhuma dúvida encontrada.
            </p>

        </section>


        <!-- ÁREA DE CONTATO -->
        <section class="ajuda">

            <div class="ajuda-icone">✉</div>

            <div class="ajuda-texto">
                <h2>Ainda precisa de ajuda?</h2>
                <p>
                    Entre em contato com nossa equipe.
                    Será um prazer ajudar!
                </p>
            </div>

            <a href="contato.php" class="btn-contato">
                Falar com a equipe
            </a>

        </section>

    </main>


    <!-- RODAPÉ -->
<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>
