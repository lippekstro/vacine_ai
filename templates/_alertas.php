
<!-- verifica se tem mensagem -->
<?php if(isset($_SESSION['alerta_msg'])): ?>
    <!-- se tiver monta uma div com a cor e a mensagem -->
    <div class="alert alert-<?= $_SESSION['tipo_alerta'] ?> m-3 text-center" role="alert">
        <?= $_SESSION['alerta_msg'] ?>
    </div>

    <!-- desfaz o alerta e a cor (para aparecer apenas uma vez) -->
    <?php 
        unset($_SESSION['alerta_msg']);
        unset($_SESSION['tipo_alerta']);
    ?>
<?php endif; ?>