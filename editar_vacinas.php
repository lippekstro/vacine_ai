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
  <div class="col-lg-9 mx-auto">

    <h3 class="mb-4">
      <i class="bi bi-pencil-square"></i> Editar Minhas Vacinas
    </h3>

    <form method="POST" action="editar-vacinas.php">
      <div class="list-group mb-4">

        <?php foreach ($vacinas as $i => $v): ?>
          <div class="list-group-item d-flex align-items-center gap-3 flex-wrap">

            <div class="form-check">
              <input class="form-check-input" type="checkbox"
                     name="vacinas[<?= $i ?>][tomada]"
                     id="vac_<?= $i ?>"
                     value="1"
                     <?= $v['status'] === 'tomada' ? 'checked' : '' ?>>
              <label class="form-check-label fw-bold" for="vac_<?= $i ?>">
                <?= htmlspecialchars($v['nome']) ?>
              </label>
            </div>

            <small class="text-muted flex-grow-1">
              (<?= $v['dose'] ?>)
            </small>

            <!-- Data -->
            <input type="date" class="form-control" style="max-width:180px"
                   name="vacinas[<?= $i ?>][data]"
                   value="<?= $v['data'] ?? '' ?>">

            <input type="hidden" name="vacinas[<?= $i ?>][nome]" value="<?= htmlspecialchars($v['nome']) ?>">
            <input type="hidden" name="vacinas[<?= $i ?>][dose]" value="<?= htmlspecialchars($v['dose']) ?>">

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