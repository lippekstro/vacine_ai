<?php
require_once __DIR__ . "/../auth/autenticacao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  
    <title>Vacine Ai</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="/vacine_ai/css/bootstrap.css">
    <link rel="stylesheet" href="/vacine_ai/css/style.css">
    

    <script src="/vacine_ai/js/bootstrap.js"></script>


 
    
</head>

<body>
    <header>

        <!-- ____________ TOPO ___________ -->
        <div class="logo">      
          <img class="logo-img" src="/vacine_ai/imgs/logo2.png" alt=""> 
            <h2>Vacine<span>Ai</span></h2>
        </div>

        <nav class="menu">
           <!-- <a href="/vacine_ai/index.php" class="menu-link">Início</a>-->




            <!--  Central  de noticias - -->
    <div class="ticker-container">
      <div class="ticker-wrapper">
        
        <!-- Bloco 1 -->
        <div class="ticker-group">
          <span class="ticker-item">📢 Campanha de Vacinação 2027 iniciada!</span>
          <span class="ticker-separator">✦</span>
          <span class="ticker-item">💉 Mantenha sua dose de Hepatite B atualizada</span>
          <span class="ticker-separator">✦</span>
        <span class="ticker-item">🌍 Cada pessoa vacinada contribui para uma comunidade mais protegida!</span>
         <span class="ticker-separator">✦</span>
          <span class="ticker-item">🗓️ Baixe o app e receba os lembretes de dose</span>
          <span class="ticker-separator">✦</span>
          <span class="ticker-item">📢 Vacine_AI: tecnologia e saúde caminhando juntas!</span>
         <span class="ticker-separator">✦</span>
            <span class="ticker-item">🛡️ A vacinação previne doenças e salva milhões de vidas!</span>
           <span class="ticker-separator">✦</span>
        </div>

        <!-- Bloco 2 (Duplicado para looping perfeito sem saltos) -->
        <div class="ticker-group">
          <span class="ticker-item">📢 Campanha de Vacinação 2027 iniciada!</span>
          <span class="ticker-separator">✦</span>
          <span class="ticker-item">💉 Mantenha sua dose de Hepatite B atualizada</span>
          <span class="ticker-separator">✦</span>
        <span class="ticker-item">🌍 Cada pessoa vacinada contribui para uma comunidade mais protegida!</span>
         <span class="ticker-separator">✦</span>
          <span class="ticker-item">🗓️ Baixe o app e receba os lembretes de dose</span>
          <span class="ticker-separator">✦</span>
          <span class="ticker-item">📢 Vacine_AI: tecnologia e saúde caminhando juntas!</span>
         <span class="ticker-separator">✦</span>
            <span class="ticker-item">🛡️ A vacinação previne doenças e salva milhões de vidas!</span>
           <span class="ticker-separator">✦</span>
        </div>

      </div>
    </div>

  

            <?php if (Autenticacao::isLogado()): ?>
                <a href="/vacine_ai/views/perfil.php" class="menu-link">Perfil</a>
                <a href="/vacine_ai/views/cadastrar_vacina.php" class="menu-link">Cadastrar Vacina</a>
                <a href="/vacine_ai/controllers/logout_controller.php" class="menu-link">Sair</a>
            <?php endif; ?>
        </nav>

        <?php if (!Autenticacao::isLogado()): ?>
            <div class="botoes-topo">
                <a href="/vacine_ai/views/login.php" class="botoes">Login</a>
                <a href="/vacine_ai/views/cadastro_usuario.php" class="botoes">Criar Conta</a>
            </div>
        <?php endif; ?>
    </header>