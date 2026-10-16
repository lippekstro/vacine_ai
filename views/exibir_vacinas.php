<?php
require '../dados.php';

$tomadas   = array_filter($vacinas, fn($v) => $v['status'] === 'tomada');
$faltantes = array_filter($vacinas, fn($v) => $v['status'] === 'faltante');

function dataBr($data) {
    return $data ? date('d/m/Y', strtotime($data)) : '—';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Perfil - Minhas Vacinas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="col-lg-11 mx-auto">

    <div class="card shadow-sm mb-4">
      <div class="card-body d-flex align-items-center gap-3 flex-wrap">
        <img src="https://via.placeholder.com/80" class="rounded-circle" alt="Avatar">
        <div class="flex-grow-1">
          <h4 class="mb-0">Nome do Usuário</h4>
          <small class="text-muted">usuario@email.com</small>
        </div>
        <a href="editar-vacinas.php" class="btn btn-primary">
          <i class="bi bi-pencil-square"></i> Editar Vacinas
        </a>
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
                  <span class="badge bg-light text-success"><?= htmlspecialchars($v['dose']) ?></span>
                </div>
                <div class="card-body">
                  <h5 class="card-title mb-2"><?= htmlspecialchars($v['nome']) ?></h5>
                  <p class="card-text text-muted mb-0">
                    <i class="bi bi-calendar-check"></i>
                    Aplicada em <?= dataBr($v['data']) ?>
                  </p>
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
                  <span class="badge bg-dark"><?= htmlspecialchars($v['dose']) ?></span>
                </div>
                <div class="card-body">
                  <h5 class="card-title mb-2"><?= htmlspecialchars($v['nome']) ?></h5>
                  <p class="card-text text-muted mb-0">
                    <i class="bi bi-calendar-x"></i> Ainda não aplicada
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

</body>
</html>
