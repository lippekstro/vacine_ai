<?php
require 'dados.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<div class="alert alert-success">Alterações salvas com sucesso!</div>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Vacinas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="col-lg-11 mx-auto">

    <h3 class="mb-4">
      <i class="bi bi-pencil-square"></i> Editar Minhas Vacinas
    </h3>

    <form method="POST" action="editar-vacinas.php">

      <div class="row g-3 mb-4">
        <?php foreach ($vacinas as $i => $v): ?>
          <?php $tomada = $v['status'] === 'tomada'; ?>

          <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm <?= $tomada ? 'border-success' : 'border-warning' ?>">

              <div class="card-header d-flex justify-content-between align-items-center
                          <?= $tomada ? 'bg-success text-white' : 'bg-warning text-dark' ?>">
                <span><?= htmlspecialchars($v['nome']) ?></span>
                <span class="badge <?= $tomada ? 'bg-light text-success' : 'bg-dark' ?>">
                  <?= htmlspecialchars($v['dose']) ?>
                </span>
              </div>

              <div class="card-body">
                <!-- Checkbox tomada -->
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox"
                         name="vacinas[<?= $i ?>][tomada]"
                         id="vac_<?= $i ?>"
                         value="1"
                         <?= $tomada ? 'checked' : '' ?>>
                  <label class="form-check-label" for="vac_<?= $i ?>">
                    Já tomei esta vacina
                  </label>
                </div>

                <label class="form-label small text-muted mb-1">Data de aplicação</label>
                <input type="date" class="form-control"
                       name="vacinas[<?= $i ?>][data]"
                       value="<?= $v['data'] ?? '' ?>">

                <input type="hidden" name="vacinas[<?= $i ?>][nome]" value="<?= htmlspecialchars($v['nome']) ?>">
                <input type="hidden" name="vacinas[<?= $i ?>][dose]" value="<?= htmlspecialchars($v['dose']) ?>">
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-save"></i> Salvar
        </button>
        <a href="perfil.php" class="btn btn-outline-secondary">Cancelar</a>
      </div>

    </form>

  </div>
</div>

</body>
</html>