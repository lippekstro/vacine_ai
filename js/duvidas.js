
// ABRIR E FECHAR PERGUNTAS

const perguntas = document.querySelectorAll(".pergunta");

perguntas.forEach(function(pergunta) {

    pergunta.addEventListener("click", function() {

        const item = pergunta.parentElement;

        item.classList.toggle("aberto");

    });

});


// PESQUISAR DÚVIDAS

const campoBusca = document.getElementById("buscarDuvida");

const itens = document.querySelectorAll(".faq-item");

const semResultado = document.getElementById("semResultado");

campoBusca.addEventListener("input", function() {

    const pesquisa = campoBusca.value.toLowerCase();

    let encontrados = 0;

    itens.forEach(function(item) {

        const texto = item.innerText.toLowerCase();

        if (texto.includes(pesquisa)) {

            item.style.display = "block";
            encontrados++;

        } else {

            item.style.display = "none";

        }

    });

    if (encontrados === 0) {

        semResultado.style.display = "block";

    } else {

        semResultado.style.display = "none";

    }

});
