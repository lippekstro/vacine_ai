<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacine Ai</title>

    <link rel="stylesheet" href="/vacine_ai/css/bootstrap.css">
    <script src="/vacine_ai/js/bootstrap.js" defer></script>
    <link rel="styleheet" href="style.css">


</head>

<body>
<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: Arial, sans-serif;

    background:
        linear-gradient(
            rgba(26, 189, 134, 0.5),
            rgba(112, 124, 136, 0.65)
        ),
        url('../assets/img/fundo-vacina.jpg');

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;

    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 16px;
}

.caixa-formulario {
    width: 100%;
    max-width: 500px;
    padding: 35px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.25);
}

.caixa-formulario h1 {
    text-align: center;
    color: #1769aa;
    font-size: 28px;
    margin: 0 0 10px;
}

.subtitulo {
    text-align: center;
    color: #64748b;
    margin-bottom: 30px;
}

.grupo {
    margin-bottom: 20px;
}

.grupo label {
    display: block;
    font-weight: bold;
    color: #334155;
    margin-bottom: 8px;
}

.grupo input,
.grupo select {
    width: 100%;
    padding: 13px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    background: #fff;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

.grupo input:focus,
.grupo select:focus {
    border-color: #2196f3;
    box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.15);
}

.botao-cadastrar {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 10px;
    background: #1976d2;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.botao-cadastrar:hover {
    background: #0d47a1;
    transform: translateY(-2px);
}

@media (max-width: 480px) {
    .caixa-formulario {
        padding: 24px 20px;
    }

    .caixa-formulario h1 {
        font-size: 24px;
    }
}
</style>
</body>