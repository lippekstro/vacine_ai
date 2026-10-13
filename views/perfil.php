
<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

/* =====================================
   INICIALIZAÇÃO DOS DADOS
===================================== */

if (!isset($_SESSION['vacinas'])) {
    $_SESSION['vacinas'] = [];
}

if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = [
        'nome' => 'Usuário',
        'email' => '',
        'nascimento' => ''
    ];
}

if (!isset($_SESSION['config'])) {
    $_SESSION['config'] = [
        'lembretes' => 'sim',
        'tamanho' => 'normal'
    ];
}

$vacinas = &$_SESSION['vacinas'];
$perfil = &$_SESSION['perfil'];
$config = &$_SESSION['config'];

function escapar($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

function redirecionar($aba) {
    header('Location: index.php?tab=' . urlencode($aba));
    exit;
}

$aba = $_GET['tab'] ?? 'inicio';
$abasPermitidas = [
    'inicio', 'calendario', 'vacinas',
    'historico', 'relatorios', 'perfil', 'configuracoes'
];

if (!in_array($aba, $abasPermitidas, true)) {
    $aba = 'inicio';
}

/* =====================================
   EXPORTAÇÃO DO RELATÓRIO CSV
===================================== */

if (isset($_GET['exportar']) && $_GET['exportar'] === 'csv') {
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="relatorio_vacinas.csv"');

    $arquivo = fopen('php://output', 'w');
    fwrite($arquivo, "\xEF\xBB\xBF");

    fputcsv($arquivo, ['Vacina', 'Dose', 'Data', 'Status'], ';');

    foreach ($vacinas as $vacina) {
        fputcsv($arquivo, [
            $vacina['nome'],
            $vacina['dose'],
            $vacina['data'],
            $vacina['status'] === 'concluida' ? 'Concluída' : 'Pendente'
        ], ';');
    }

    fclose($arquivo);
    exit;
}

/* =====================================
   PROCESSAMENTO DOS FORMULÁRIOS
===================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    // Cadastrar ou editar vacina
    if ($acao === 'salvar_vacina') {
        $id = $_POST['id'] ?? '';
        $nome = trim($_POST['nome'] ?? '');
        $dose = trim($_POST['dose'] ?? '');
        $data = $_POST['data'] ?? '';
        $status = $_POST['status'] ?? 'pendente';

        $dataValida = DateTime::createFromFormat('!Y-m-d', $data);

        if (
            $nome !== '' &&
            $dose !== '' &&
            $dataValida &&
            $dataValida->format('Y-m-d') === $data &&
            in_array($status, ['pendente', 'concluida'], true)
        ) {
            if ($id !== '' && isset($vacinas[$id])) {
                $vacinas[$id]['nome'] = $nome;
                $vacinas[$id]['dose'] = $dose;
                $vacinas[$id]['data'] = $data;
                $vacinas[$id]['status'] = $status;
            } else {
                $novoId = uniqid('vacina_', true);

                $vacinas[$novoId] = [
                    'id' => $novoId,
                    'nome' => $nome,
                    'dose' => $dose,
                    'data' => $data,
                    'status' => $status
                ];
            }

            redirecionar('vacinas');
        }

        redirecionar('vacinas&erro=1');
    }

    // Excluir vacina
    if ($acao === 'excluir_vacina') {
        $id = $_POST['id'] ?? '';

        if (isset($vacinas[$id])) {
            unset($vacinas[$id]);
        }

        redirecionar('vacinas');
    }

    // Alterar status da vacina
    if ($acao === 'alterar_status') {
        $id = $_POST['id'] ?? '';

        if (isset($vacinas[$id])) {
            $vacinas[$id]['status'] =
                $vacinas[$id]['status'] === 'concluida'
                ? 'pendente'
                : 'concluida';
        }

        redirecionar('vacinas');
    }

    // Salvar perfil
    if ($acao === 'salvar_perfil') {
        $perfil['nome'] = trim($_POST['nome'] ?? 'Usuário');
        $perfil['email'] = trim($_POST['email'] ?? '');
        $perfil['nascimento'] = $_POST['nascimento'] ?? '';

        redirecionar('perfil');
    }

    // Salvar configurações
    if ($acao === 'salvar_config') {
        $config['lembretes'] =
            ($_POST['lembretes'] ?? 'nao') === 'sim' ? 'sim' : 'nao';

        $config['tamanho'] =
            ($_POST['tamanho'] ?? 'normal') === 'grande' ? 'grande' : 'normal';

        redirecionar('configuracoes');
    }
}

/* =====================================
   DADOS DOS RELATÓRIOS
===================================== */

$total = count($vacinas);
$concluidas = 0;
$pendentes = 0;
$proximas = 0;
$hoje = date('Y-m-d');

foreach ($vacinas as $vacina) {
    if ($vacina['status'] === 'concluida') {
        $concluidas++;
    } else {
        $pendentes++;

        if ($vacina['data'] >= $hoje) {
            $proximas++;
        }
    }
}

$listaVacinas = array_values($vacinas);

usort($listaVacinas, function ($a, $b) {
    return strcmp($a['data'], $b['data']);
});

/* =====================================
   CALENDÁRIO INTERATIVO
===================================== */

$mes = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');
$ano = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

if ($mes < 1 || $mes > 12 || $ano < 2000 || $ano > 2100) {
    $mes = (int)date('n');
    $ano = (int)date('Y');
}

$dataMes = new DateTime(sprintf('%04d-%02d-01', $ano, $mes));
$diasNoMes = (int)$dataMes->format('t');
$primeiroDia = (int)$dataMes->format('N');

$mesAnterior = (clone $dataMes)->modify('-1 month');
$mesSeguinte = (clone $dataMes)->modify('+1 month');

$dataSelecionada = $_GET['date'] ?? sprintf('%04d-%02d-%02d', $ano, $mes, (int)date('d'));

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataSelecionada)) {
    $dataSelecionada = $dataMes->format('Y-m-d');
}

$vacinasDoDia = [];

foreach ($listaVacinas as $vacina) {
    if ($vacina['data'] === $dataSelecionada) {
        $vacinasDoDia[] = $vacina;
    }
}

$nomesMeses = [
    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março',
    4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
    7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro',
    10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
];

$editando = null;

if (isset($_GET['editar']) && isset($vacinas[$_GET['editar']])) {
    $editando = $vacinas[$_GET['editar']];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VaccineAI | Painel</title>

<style>
* {
    box-sizing: border-box;
}

:root {
    --fundo: #ffffff;
    --texto: #111111;
    --secundario: #666666;
    --borda: #dddddd;
    --painel: #f7f7f7;
}

body {
    margin: 0;
    background: var(--fundo);
    color: var(--texto);
    font-family: Arial, Helvetica, sans-serif;
    font-size: <?= $config['tamanho'] === 'grande' ? '18px' : '15px' ?>;
}

a {
    color: inherit;
    text-decoration: none;
}

button, input, select {
    font: inherit;
}

button, .botao {
    display: inline-block;
    border: 1px solid var(--texto);
    background: var(--texto);
    color: white;
    padding: 10px 14px;
    cursor: pointer;
    border-radius: 5px;
    text-decoration: none;
}

button:hover, .botao:hover {
    opacity: .78;
}

.botao-secundario {
    background: white;
    color: var(--texto);
}

.layout {
    display: flex;
    min-height: 100vh;
}

.menu-lateral {
    width: 245px;
    flex-shrink: 0;
    padding: 25px 16px;
    border-right: 1px solid var(--borda);
}

.logo {
    font-size: 22px;
    font-weight: bold;
    margin: 5px 10px 35px;
}

.menu-lateral a {
    display: block;
    padding: 13px 12px;
    margin-bottom: 5px;
    border-radius: 5px;
}

.menu-lateral a:hover,
.menu-lateral a.ativo {
    background: var(--painel);
    font-weight: bold;
}

.conteudo {
    flex: 1;
    min-width: 0;
    padding: 30px;
}

.cabecalho {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}

h1 {
    font-size: 27px;
    margin: 0 0 8px;
}

h2 {
    font-size: 20px;
    margin-top: 0;
}

.subtitulo, .texto-secundario {
    color: var(--secundario);
}

.grade {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 25px;
}

.cartao {
    border: 1px solid var(--borda);
    padding: 20px;
    border-radius: 8px;
    background: white;
    margin-bottom: 18px;
}

.numero {
    font-size: 30px;
    font-weight: bold;
    margin-top: 10px;
}

.formulario {
    display: grid;
    gap: 15px;
    max-width: 650px;
}

.campo {
    display: grid;
    gap: 7px;
}

input, select {
    width: 100%;
    padding: 11px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    background: white;
    color: black;
}

.acoes {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
}

.acoes form {
    display: inline;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    text-align: left;
    padding: 13px 10px;
    border-bottom: 1px solid var(--borda);
}

th {
    background: var(--painel);
}

.tabela-container {
    overflow-x: auto;
}

.estado {
    display: inline-block;
    border: 1px solid var(--borda);
    padding: 5px 8px;
    border-radius: 20px;
    font-size: 12px;
}

.calendario-cabecalho {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 20px;
}

.grade-calendario {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 6px;
}

.dia-semana {
    text-align: center;
    padding: 8px 0;
    color: var(--secundario);
    font-size: 12px;
}

.dia {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 75px;
    padding: 8px;
    border: 1px solid var(--borda);
    background: white;
    color: black;
    border-radius: 5px;
}

.dia.selecionado {
    outline: 2px solid black;
}

.dia.hoje {
    font-weight: bold;
}

.marcador {
    font-size: 11px;
    color: var(--secundario);
}

.vazio {
    min-height: 75px;
}

.rodape {
    margin-top: 35px;
    color: var(--secundario);
    font-size: 12px;
}

@media (max-width: 800px) {
    .layout {
        display: block;
    }

    .menu-lateral {
        width: 100%;
        border-right: 0;
        border-bottom: 1px solid var(--borda);
        padding: 15px;
    }

    .logo {
        margin-bottom: 15px;
    }

    .menu-links {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 3px;
    }

    .conteudo {
        padding: 20px 14px;
    }

    .grade {
        grid-template-columns: 1fr;
    }

    .dia {
        min-height: 55px;
        padding: 5px;
        font-size: 12px;
    }

    .vazio {
        min-height: 55px;
    }

    th, td {
        padding: 10px 8px;
    }
}
</style>
</head>

<body>
<div class="layout">

<aside class="menu-lateral">
    <div class="logo">VaccineAI</div>

    <nav class="menu-links">
        <?php
        $itensMenu = [
            'inicio' => 'Painel inicial',
            'calendario' => 'Calendário',
            'vacinas' => 'Minhas vacinas',
            'historico' => 'Histórico',
            'relatorios' => 'Relatórios',
            'perfil' => 'Meu perfil',
            'configuracoes' => 'Configurações'
        ];

        foreach ($itensMenu as $chave => $nome) {
            $classe = $aba === $chave ? 'ativo' : '';
            echo '<a class="' . $classe . '" href="index.php?tab=' .
                escapar($chave) . '">' . escapar($nome) . '</a>';
        }
        ?>
    </nav>
</aside>

<main class="conteudo">

<header class="cabecalho">
    <div>
        <h1>
            <?php
            $titulos = [
                'inicio' => 'Painel inicial',
                'calendario' => 'Calendário de vacinação',
                'vacinas' => 'Minhas vacinas',
                'historico' => 'Histórico de vacinação',
                'relatorios' => 'Relatórios',
                'perfil' => 'Meu perfil',
                'configuracoes' => 'Configurações'
            ];
            echo escapar($titulos[$aba]);
            ?>
        </h1>
        <div class="subtitulo">
            Bem-vindo(a), <?= escapar($perfil['nome']) ?>.
        </div>
    </div>

    <a class="botao botao-secundario" href="index.php?tab=perfil">
        Editar perfil
    </a>
</header>

<?php if ($aba === 'inicio'): ?>

    <div class="grade">
        <section class="cartao">
            <div class="texto-secundario">Total de vacinas</div>
            <div class="numero"><?= $total ?></div>
        </section>

        <section class="cartao">
            <div class="texto-secundario">Concluídas</div>
            <div class="numero"><?= $concluidas ?></div>
        </section>

        <section class="cartao">
            <div class="texto-secundario">Pendentes</div>
            <div class="numero"><?= $pendentes ?></div>
        </section>
    </div>

    <section class="cartao">
        <h2>Próximas vacinações</h2>

        <?php
        $encontrou = false;

        foreach ($listaVacinas as $vacina):
            if ($vacina['status'] === 'pendente' && $vacina['data'] >= $hoje):
                $encontrou = true;
        ?>
            <p>
                <strong><?= escapar($vacina['nome']) ?></strong>
                — <?= escapar($vacina['dose']) ?>
                — <?= date('d/m/Y', strtotime($vacina['data'])) ?>
            </p>
        <?php
            endif;
        endforeach;

        if (!$encontrou):
        ?>
            <p class="texto-secundario">
                Nenhuma vacinação futura pendente cadastrada.
            </p>
        <?php endif; ?>

        <a class="botao" href="index.php?tab=vacinas">Gerenciar vacinas</a>
        <a class="botao botao-secundario" href="index.php?tab=calendario">Abrir calendário</a>
    </section>

<?php elseif ($aba === 'vacinas'): ?>

    <section class="cartao">
        <h2><?= $editando ? 'Editar vacina' : 'Cadastrar nova vacina' ?></h2>

        <?php if (isset($_GET['erro'])): ?>
            <p>Confira o nome, a dose e a data informados.</p>
        <?php endif; ?>

        <form method="post" class="formulario">
            <input type="hidden" name="acao" value="salvar_vacina">
            <input type="hidden" name="id" value="<?= escapar($editando['id'] ?? '') ?>">

            <div class="campo">
                <label for="nome">Nome da vacina</label>
                <input id="nome" name="nome" required
                       value="<?= escapar($editando['nome'] ?? '') ?>"
                       placeholder="Ex.: Vacina contra gripe">
            </div>

            <div class="campo">
                <label for="dose">Dose</label>
                <input id="dose" name="dose" required
                       value="<?= escapar($editando['dose'] ?? '') ?>"
                       placeholder="Ex.: 1ª dose">
            </div>

            <div class="campo">
                <label for="data">Data da vacinação</label>
                <input id="data" type="date" name="data" required
                       value="<?= escapar($editando['data'] ?? date('Y-m-d')) ?>">
            </div>

            <div class="campo">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="pendente"
                        <?= ($editando['status'] ?? '') === 'pendente' ? 'selected' : '' ?>>
                        Pendente
                    </option>
                    <option value="concluida"
                        <?= ($editando['status'] ?? '') === 'concluida' ? 'selected' : '' ?>>
                        Concluída
                    </option>
                </select>
            </div>

            <div class="acoes">
                <button type="submit">
                    <?= $editando ? 'Salvar alterações' : 'Cadastrar vacina' ?>
                </button>

                <?php if ($editando): ?>
                    <a class="botao botao-secundario" href="index.php?tab=vacinas">
                        Cancelar
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="cartao">
        <h2>Vacinas cadastradas</h2>

        <?php if (!$listaVacinas): ?>
            <p class="texto-secundario">Nenhuma vacina cadastrada ainda.</p>
        <?php else: ?>
        <div class="tabela-container">
            <table>
                <thead>
                <tr>
                    <th>Vacina</th>
                    <th>Dose</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listaVacinas as $vacina): ?>
                <tr>
                    <td><?= escapar($vacina['nome']) ?></td>
                    <td><?= escapar($vacina['dose']) ?></td>
                    <td><?= date('d/m/Y', strtotime($vacina['data'])) ?></td>
                    <td>
                        <span class="estado">
                            <?= $vacina['status'] === 'concluida' ? 'Concluída' : 'Pendente' ?>
                        </span>
                    </td>
                    <td>
                        <div class="acoes">
                            <a class="botao botao-secundario"
                               href="index.php?tab=vacinas&editar=<?= urlencode($vacina['id']) ?>">
                                Editar
                            </a>

                            <form method="post">
                                <input type="hidden" name="acao" value="alterar_status">
                                <input type="hidden" name="id" value="<?= escapar($vacina['id']) ?>">
                                <button type="submit" class="botao-secundario">
                                    <?= $vacina['status'] === 'concluida' ? 'Reabrir' : 'Concluir' ?>
                                </button>
                            </form>

                            <form method="post"
                                  onsubmit="return confirm('Deseja excluir esta vacina?')">
                                <input type="hidden" name="acao" value="excluir_vacina">
                                <input type="hidden" name="id" value="<?= escapar($vacina['id']) ?>">
                                <button type="submit">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </section>

<?php elseif ($aba === 'calendario'): ?>

    <section class="cartao">
        <div class="calendario-cabecalho">
            <a class="botao botao-secundario"
               href="index.php?tab=calendario&month=<?= $mesAnterior->format('n') ?>&year=<?= $mesAnterior->format('Y') ?>">
                Anterior
            </a>

            <h2><?= escapar($nomesMeses[$mes]) ?> de <?= $ano ?></h2>

            <a class="botao botao-secundario"
               href="index.php?tab=calendario&month=<?= $mesSeguinte->format('n') ?>&year=<?= $mesSeguinte->format('Y') ?>">
                Próximo
            </a>
        </div>

        <div class="grade-calendario">
            <?php foreach (['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'] as $diaNome): ?>
                <div class="dia-semana"><?= $diaNome ?></div>
            <?php endforeach; ?>

            <?php for ($i = 1; $i < $primeiroDia; $i++): ?>
                <div class="vazio"></div>
            <?php endfor; ?>

            <?php for ($dia = 1; $dia <= $diasNoMes; $dia++):
                $dataDia = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);
                $quantidade = 0;

                foreach ($listaVacinas as $vacina) {
                    if ($vacina['data'] === $dataDia) {
                        $quantidade++;
                    }
                }

                $classes = 'dia';
                if ($dataDia === $dataSelecionada) $classes .= ' selecionado';
                if ($dataDia === $hoje) $classes .= ' hoje';
            ?>
                <a class="<?= $classes ?>"
                   href="index.php?tab=calendario&month=<?= $mes ?>&year=<?= $ano ?>&date=<?= $dataDia ?>">
                    <span><?= $dia ?></span>
                    <?php if ($quantidade > 0): ?>
                        <span class="marcador">
                            <?= $quantidade ?> vacina(s)
                        </span>
                    <?php endif; ?>
                </a>
            <?php endfor; ?>
        </div>
    </section>

    <section class="cartao">
        <h2>Vacinações de <?= date('d/m/Y', strtotime($dataSelecionada)) ?></h2>

        <?php if (!$vacinasDoDia): ?>
            <p class="texto-secundario">
                Não há vacinas cadastradas para este dia.
            </p>
        <?php else: ?>
            <?php foreach ($vacinasDoDia as $vacina): ?>
                <p>
                    <strong><?= escapar($vacina['nome']) ?></strong>
                    — <?= escapar($vacina['dose']) ?>
                    — <?= $vacina['status'] === 'concluida' ? 'Concluída' : 'Pendente' ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <a class="botao"
           href="index.php?tab=vacinas">
            Cadastrar ou editar vacina
        </a>
    </section>

<?php elseif ($aba === 'historico'): ?>

    <section class="cartao">
        <h2>Vacinas concluídas</h2>

        <?php
        $historico = array_filter($listaVacinas, function ($vacina) {
            return $vacina['status'] === 'concluida';
        });
        ?>

        <?php if (!$historico): ?>
            <p class="texto-secundario">
                Ainda não há vacinas concluídas no histórico.
            </p>
        <?php else: ?>
        <div class="tabela-container">
            <table>
                <thead>
                <tr>
                    <th>Vacina</th>
                    <th>Dose</th>
                    <th>Data cadastrada</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($historico as $vacina): ?>
                    <tr>
                        <td><?= escapar($vacina['nome']) ?></td>
                        <td><?= escapar($vacina['dose']) ?></td>
                        <td><?= date('d/m/Y', strtotime($vacina['data'])) ?></td>
                        <td><span class="estado">Concluída</span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <p class="texto-secundario">
            O histórico utiliza o status e a data informados no cadastro.
            Marque uma vacina como concluída após confirmar que ela foi realizada.
        </p>
    </section>

<?php elseif ($aba === 'relatorios'): ?>

    <div class="grade">
        <section class="cartao">
            <div class="texto-secundario">Total cadastradas</div>
            <div class="numero"><?= $total ?></div>
        </section>

        <section class="cartao">
            <div class="texto-secundario">Concluídas</div>
            <div class="numero"><?= $concluidas ?></div>
        </section>

        <section class="cartao">
            <div class="texto-secundario">Pendentes</div>
            <div class="numero"><?= $pendentes ?></div>
        </section>
    </div>

    <section class="cartao">
        <h2>Resumo do relatório</h2>

        <p>Vacinas cadastradas: <strong><?= $total ?></strong></p>
        <p>Vacinas concluídas: <strong><?= $concluidas ?></strong></p>
        <p>Vacinas pendentes: <strong><?= $pendentes ?></strong></p>
        <p>Vacinações pendentes com data de hoje ou futura: <strong><?= $proximas ?></strong></p>

        <a class="botao" href="index.php?exportar=csv">
            Exportar relatório CSV
        </a>
    </section>

<?php elseif ($aba === 'perfil'): ?>

    <section class="cartao">
        <h2>Informações pessoais</h2>

        <form method="post" class="formulario">
            <input type="hidden" name="acao" value="salvar_perfil">

            <div class="campo">
                <label for="nome">Nome</label>
                <input id="nome" name="nome" required
                       value="<?= escapar($perfil['nome']) ?>">
            </div>

            <div class="campo">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email"
                       value="<?= escapar($perfil['email']) ?>">
            </div>

            <div class="campo">
                <label for="nascimento">Data de nascimento</label>
                <input id="nascimento" name="nascimento" type="date"
                       value="<?= escapar($perfil['nascimento']) ?>">
            </div>

            <button type="submit">Salvar perfil</button>
        </form>
    </section>

<?php elseif ($aba === 'configuracoes'): ?>

    <section class="cartao">
        <h2>Preferências do sistema</h2>

        <form method="post" class="formulario">
            <input type="hidden" name="acao" value="salvar_config">

            <div class="campo">
                <label for="lembretes">Preferência de lembretes</label>
                <select id="lembretes" name="lembretes">
                    <option value="sim" <?= $config['lembretes'] === 'sim' ? 'selected' : '' ?>>
                        Ativados
                    </option>
                    <option value="nao" <?= $config['lembretes'] === 'nao' ? 'selected' : '' ?>>
                        Desativados
                    </option>
                </select>
            </div>

            <div class="campo">
                <label for="tamanho">Tamanho do texto</label>
                <select id="tamanho" name="tamanho">
                    <option value="normal" <?= $config['tamanho'] === 'normal' ? 'selected' : '' ?>>
                        Normal
                    </option>
                    <option value="grande" <?= $config['tamanho'] === 'grande' ? 'selected' : '' ?>>
                        Grande
                    </option>
                </select>
            </div>

            <button type="submit">Salvar configurações</button>
        </form>

        <p class="texto-secundario">
            As preferências ficam salvas na sessão do navegador.
            A opção de lembretes registra sua preferência, mas não envia
            notificações automáticas.
        </p>
    </section>

<?php endif; ?>

<footer class="rodape">
    VaccineAI — Painel de organização de vacinação.
    Os dados deste exemplo ficam na sessão PHP e não substituem uma base
    de dados permanente nem orientação de profissionais de saúde.
</footer>

</main>
</div>
</body>
</html>