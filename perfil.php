<?php
require 'dados.php';

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
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <div class="card shadow-sm mb-4">
        <div class="card-body d-flex align-items-center gap-3">
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
              <h5 class="text-success">
                <i class="bi bi-check-circle-fill"></i> Tomadas
              </h5>
              <h2 class="mb-0"><?= count($tomadas) ?></h2>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card border-warning shadow-sm">
            <div class="card-body">
              <h5 class="text-warning">
                <i class="bi bi-exclamation-triangle-fill"></i> Faltam Tomar
              </h5>
              <h2 class="mb-0"><?= count($faltantes) ?></h2>
            </div>
          </div>
        </div>
      </div>

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tomadas" type="button">
            <i class="bi bi-check2-circle"></i> Vacinas Tomadas
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#faltantes" type="button">
            <i class="bi bi-clock-history"></i> Vacinas Faltantes
          </button>
        </li>
      </ul>

      <div class="tab-content bg-white p-4 border border-top-0 rounded-bottom shadow-sm">

        <div class="tab-pane fade show active" id="tomadas">
          <?php if (empty($tomadas)): ?>
            <p class="text-muted text-center mb-0">Nenhuma vacina tomada registrada.</p>
          <?php else: ?>
            <div class="list-group">
              <?php foreach ($tomadas as $v): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="mb-1">
                      <?= htmlspecialchars($v['nome']) ?>
                      <span class="badge bg-secondary ms-1"><?= $v['dose'] ?></span>
                    </h6>
                    <small class="text-muted">
                      <i class="bi bi-calendar-check"></i>
                      Aplicada em <?= dataBr($v['data']) ?>
                    </small>
                  </div>
                  <span class="badge bg-success rounded-pill">Tomada</span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="faltantes">
          <?php if (empty($faltantes)): ?>
            <p class="text-muted text-center mb-0">Você está em dia! 🎉</p>
          <?php else: ?>
            <div class="list-group">
              <?php foreach ($faltantes as $v): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="mb-1">
                      <?= htmlspecialchars($v['nome']) ?>
                      <span class="badge bg-secondary ms-1"><?= $v['dose'] ?></span>
                    </h6>
                    <small class="text-muted">
                      <i class="bi bi-calendar-x"></i> Ainda não aplicada
                    </small>
                  </div>
                  <span class="badge bg-warning text-dark rounded-pill">Pendente</span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>