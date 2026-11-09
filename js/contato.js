
const formulario = document.getElementById("formContato");

const retorno = document.getElementById("retorno");

formulario.addEventListener("submit", function(event) {

    event.preventDefault();

    const nome = document.getElementById("nome").value;

    const email = document.getElementById("email").value;

    const assunto = document.getElementById("assunto").value;

    const mensagem = document.getElementById("mensagem").value;


    if (
        nome.trim() === "" ||
        email.trim() === "" ||
        assunto === "" ||
        mensagem.trim() === ""
    ) {

        retorno.textContent = "Preencha todos os campos.";

        retorno.style.color = "red";

        return;

    }


    retorno.textContent =
        "Mensagem preenchida com sucesso!";

    retorno.style.color = "#009e70";

    formulario.reset();

});
