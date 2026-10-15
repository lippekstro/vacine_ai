<?php 
require_once __DIR__ . "/../templates/_cabecalho.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil - Minhas Vacinas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <!-- Card do Perfil -->
      <div class="card shadow-sm mb-4">
        <div class="card-body d-flex align-items-center gap-3">
          <img src="https://via.placeholder.com/80" class="rounded-circle" alt="Avatar">
          <div class="flex-grow-1">
            <h4 class="mb-0">Nome do Usuário</h4>
            <small class="text-muted">usuario@email.com</small>
          </div>
          <a href="editar-vacinas.html" class="btn btn-primary">
            <i class="bi bi-pencil-square"></i> Editar Vacinas
          </a>
        </div>
      </div>

      <!-- Resumo -->
      <div class="row mb-4">
        <div class="col-md-6 mb-3">
          <div class="card border-success shadow-sm">
            <div class="card-body">
              <h5 class="text-success"><i class="bi bi-check-circle-fill"></i> Tomadas</h5>
              <h2 class="mb-0" id="totalTomadas">0</h2>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card border-warning shadow-sm">
            <div class="card-body">
              <h5 class="text-warning"><i class="bi bi-exclamation-triangle-fill"></i> Faltam Tomar</h5>
              <h2 class="mb-0" id="totalFaltantes">0</h2>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabs -->
      <ul class="nav nav-tabs" id="vacinasTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="tomadas-tab" data-bs-toggle="tab" 
                  data-bs-target="#tomadas" type="button" role="tab">
            <i class="bi bi-check2-circle"></i> Vacinas Tomadas
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="faltantes-tab" data-bs-toggle="tab" 
                  data-bs-target="#faltantes" type="button" role="tab">
            <i class="bi bi-clock-history"></i> Vacinas Faltantes
          </button>
        </li>
      </ul>

      <div class="tab-content bg-white p-4 border border-top-0 rounded-bottom shadow-sm">

        <!-- ABA TOMADAS -->
        <div class="tab-pane fade show active" id="tomadas" role="tabpanel">
          <div class="list-group" id="listaTomadas">
            <!-- Preenchido via JS -->
          </div>
        </div>

        <!-- ABA FALTANTES -->
        <div class="tab-pane fade" id="faltantes" role="tabpanel">
          <div class="list-group" id="listaFaltantes">
            <!-- Preenchido via JS -->
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="perfil-vacinas.js"></script>
</body>
</html>


<?php 
require_once __DIR__ . "/../templates/_rodape.php";
?>