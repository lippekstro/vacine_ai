<?php
require_once __DIR__ . "/../templates/_cabecalho.php";
require_once __DIR__ . "/../models/usuario.php";
require_once __DIR__ . "/../models/vacinacao.php";

if (!Autenticacao::isLogado()) {
  header('Location: /vacine_ai/views/login.php');
  exit();
}

$usuario = new Usuario($_SESSION['id_usuario']);
$tomadas = Vacinacao::listarTomadasPorUsuario($_SESSION['id_usuario']);
$faltantes = Vacinacao::listarFaltantesPorUsuario($_SESSION['id_usuario']);

?>

<div class="container py-5">
  <div class="col-lg-11 mx-auto">

    <div class="card shadow-sm mb-4">
      <div class="card-body d-flex align-items-center gap-3 flex-wrap">
        <?php if ($usuario->getFoto() != null): ?>
          <img src="/vacine_ai/imgs/fotos/<?= htmlspecialchars($usuario->getFoto()) ?>" alt="Foto de perfil" class="rounded-circle img-thumbnail mb-3" width="80" height="80" style="object-fit: cover; min-width: 80px; min-height: 80px">
        <?php else: ?>
          <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 80px; height: 80px">
            <?= mb_strtoupper(mb_substr($usuario->getNome(), 0, 1)) ?>
          </div>
        <?php endif; ?>
        <div class="flex-grow-1">
          <h4 class="mb-0"><?= $usuario->getNome() ?></h4>
          <small class="text-muted"><?= $usuario->getEmail()  ?></small>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <div class="card border-success shadow-sm">
          <div class="card-body">
            <h5 class="text-success mb-1">
              <i class="bi bi-check-circle-fill"></i> Tomadas
            </h5>
            <h2 class="mb-0"><?= count($tomadas) ?></h2>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card border-warning shadow-sm">
          <div class="card-body">
            <h5 class="text-warning mb-1">
              <i class="bi bi-exclamation-triangle-fill"></i> Faltam Tomar
            </h5>
            <h2 class="mb-0"><?= count($faltantes) ?></h2>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-5">
      <h4 class="mb-3 text-success">
        <i class="bi bi-shield-check"></i> Vacinas Tomadas
        <span class="badge bg-success"><?= count($tomadas) ?></span>
      </h4>

      <?php if (empty($tomadas)): ?>
        <div class="alert alert-light border text-center mb-0">
          Nenhuma vacina tomada registrada.
        </div>
      <?php else: ?>
        <div class="row g-3">
          <?php foreach ($tomadas as $v): ?>
            <div class="col-md-6 col-lg-4">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                  <span><i class="bi bi-check-circle"></i> Tomada</span>
                  <span class="badge bg-light text-success"><?= $v['qtd_doses'] == 1 ? 'dose única' : htmlspecialchars($v['dose']) . 'ª dose' ?></span>
                </div>
                <div class="card-body">
                  <h5 class="card-title mb-2"><?= htmlspecialchars($v['nome_vacina']) ?></h5>
                  <p class="card-text text-muted mb-0">
                    <i class="bi bi-calendar-check"></i>
                    Aplicada em <?= date('d/m/Y', strtotime($v['dt_aplicacao']))  ?>
                  </p>
                  <a href="/vacine_ai/views/editar_vacina.php?id=<?= $v['id_vacinacao'] ?>" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Editar Vacinas
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="mb-5">
      <h4 class="mb-3 text-warning">
        <i class="bi bi-clock-history"></i> Vacinas Faltantes
        <span class="badge bg-warning text-dark"><?= count($faltantes) ?></span>
      </h4>

      <?php if (empty($faltantes)): ?>
        <div class="alert alert-success text-center mb-0">
          🎉 Você está em dia com todas as vacinas!
        </div>
      <?php else: ?>
        <div class="row g-3">
          <?php foreach ($faltantes as $v): ?>
            <div class="col-md-6 col-lg-4">
              <div class="card h-100 border-warning shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                  <span><i class="bi bi-exclamation-triangle"></i> Pendente</span>
                  <span class="badge bg-dark"><?= htmlspecialchars($v['dose'] + 1) ?>ª dose</span>
                </div>
                <div class="card-body">
                  <h5 class="card-title mb-2"><?= htmlspecialchars($v['nome_vacina']) ?></h5>
                  <p class="card-text text-muted mb-0">
                    <i class="bi bi-calendar-x"></i> Data da Próxima dose: <?= date('d/m/Y', strtotime($v['dt_proxima']))  ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>

<?php
require_once __DIR__ . "/../templates/_rodape.php";
?>