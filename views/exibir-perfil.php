<?php
session_start();


if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = [
        'nome' => 'Luis Felipe',
        'apelido' => 'Luis',
        'genero' => 'Masculino',
        'pais' => 'Brasil',
        'idioma' => 'Português',
        'fuso' => 'America/Sao_Paulo',
        'emails' => [
            ['id' => 1, 'email' => 'alexarawles@gmail.com', 'quando' => '1 mês atrás']
        ]
    ];
}
if (!isset($_SESSION['proximo_email_id'])) {
    $_SESSION['proximo_email_id'] = 2;
}

function e($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

$mensagem = '';
$tipoMensagem = 'sucesso';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'salvar_perfil') {
        $_SESSION['perfil']['nome'] = trim($_POST['nome'] ?? '');
        $_SESSION['perfil']['apelido'] = trim($_POST['apelido'] ?? '');
        $_SESSION['perfil']['genero'] = trim($_POST['genero'] ?? '');
        $_SESSION['perfil']['pais'] = trim($_POST['pais'] ?? '');
        $_SESSION['perfil']['idioma'] = trim($_POST['idioma'] ?? '');
        $_SESSION['perfil']['fuso'] = trim($_POST['fuso'] ?? '');

        if ($_SESSION['perfil']['nome'] === '') {
            $_SESSION['perfil']['nome'] = 'Seu nome';
        }
        $mensagem = 'Perfil atualizado com sucesso!';
    } elseif ($acao === 'adicionar_email') {
        $email = trim($_POST['novo_email'] ?? '');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $existe = false;
            foreach ($_SESSION['perfil']['emails'] as $item) {
                if (strtolower($item['email']) === strtolower($email)) {
                    $existe = true;
                    break;
                }
            }
            if ($existe) {
                $mensagem = 'Esse e-mail já está cadastrado.';
                $tipoMensagem = 'erro';
            } else {
                $_SESSION['perfil']['emails'][] = [
                    'id' => $_SESSION['proximo_email_id']++,
                    'email' => $email,
                    'quando' => 'adicionado agora'
                ];
                $mensagem = 'E-mail adicionado!';
            }
        } else {
            $mensagem = 'Digite um endereço de e-mail válido.';
            $tipoMensagem = 'erro';
        }
    } elseif ($acao === 'remover_email') {
        $id = (int)($_POST['email_id'] ?? 0);
        $_SESSION['perfil']['emails'] = array_values(array_filter(
            $_SESSION['perfil']['emails'],
            fn($item) => (int)$item['id'] !== $id
        ));
        $mensagem = 'E-mail removido.';
    }

    // Evita reenviar o formulário ao atualizar a página.
    $_SESSION['flash'] = ['texto' => $mensagem, 'tipo' => $tipoMensagem];
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}

if (isset($_SESSION['flash'])) {
    $mensagem = $_SESSION['flash']['texto'];
    $tipoMensagem = $_SESSION['flash']['tipo'];
    unset($_SESSION['flash']);
}

$perfil = $_SESSION['perfil'];
$iniciais = '';
foreach (preg_split('/\s+/', trim($perfil['nome'])) as $parte) {
    if ($parte !== '') $iniciais .= mb_substr($parte, 0, 1, 'UTF-8');
}
$iniciais = mb_strtoupper(mb_substr($iniciais, 0, 2, 'UTF-8'), 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meu perfil</title>
<style>
:root {
    --azul: #4385ff;
    --azul-claro: #edf4ff;
    --texto: #202638;
    --cinza: #8d929e;
    --fundo-campo: #f7f8fa;
    --borda: #edf0f4;
}
* { box-sizing: border-box; }
body {
    margin: 0;
    min-height: 100vh;
    padding: 18px;
    font-family: Inter, "Segoe UI", Arial, sans-serif;
    color: var(--texto);
    background: linear-gradient(120deg, #c4d8ff 0%, #d9e9f6 48%, #fff7df 100%);
}
button, input, select { font: inherit; }
button { cursor: pointer; }
.app {
    display: flex;
    width: min(1240px, 100%);
    min-height: calc(100vh - 36px);
    margin: auto;
    overflow: hidden;
    background: #fff;
    border: 1px solid rgba(255,255,255,.85);
    border-radius: 28px;
    box-shadow: 0 6px 28px rgba(35, 52, 82, .18);
}
.sidebar {
    width: 78px;
    flex: 0 0 78px;
    background: #fff;
    border-right: 1px solid #f4f5f7;
    padding-top: 105px;
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 12px;
}
.nav-btn {
    position: relative;
    width: 52px;
    height: 43px;
    border: 0;
    border-radius: 0 8px 8px 0;
    color: #b9bdc5;
    background: transparent;
    font-size: 21px;
    transition: .2s;
}
.nav-btn:hover, .nav-btn.active { color: var(--azul); background: #edf4ff; }
.nav-btn::after {
    content: attr(data-label);
    position: absolute;
    left: 61px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
    display: none;
    padding: 7px 10px;
    color: white;
    background: #273247;
    border-radius: 6px;
    white-space: nowrap;
    font-size: 12px;
}
.nav-btn:hover::after { display: block; }
main { flex: 1; min-width: 0; padding: 24px 26px 22px; }
.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 24px;
}
.welcome h1 { font-size: 17px; margin: 0 0 9px; font-weight: 650; }
.welcome p { color: #b2b5bd; font-size: 11px; margin: 0; }
.top-actions { display: flex; align-items: center; gap: 12px; }
.search-wrap {
    display: flex; align-items: center; gap: 10px;
    background: #fafbfc; border: 1px solid #f5f6f8;
    border-radius: 7px; padding: 0 12px; width: 245px; height: 39px;
}
.search-wrap span { color: #a8adb6; font-size: 20px; }
.search-wrap input { border: 0; outline: 0; background: transparent; width: 100%; font-size: 12px; }
.icon-btn {
    width: 39px; height: 39px; border: 1px solid #f0f1f4;
    background: #fff; border-radius: 8px; color: #a2a7b0; font-size: 17px;
}
.avatar-small, .avatar-large {
    display: grid; place-items: center; overflow: hidden;
    color: #fff; font-weight: 700;
    background: linear-gradient(145deg, #c6d8ff, #6d8ed7 55%, #303b70);
}
.avatar-small { width: 38px; height: 38px; border-radius: 9px; font-size: 12px; }
.cover {
    height: 69px;
    border-radius: 8px 8px 0 0;
    background: linear-gradient(105deg, #b9d8f8 0%, #dbe4ed 43%, #fff7df 100%);
}
.profile-card { background: #fff; border: 1px solid #f5f6f7; }
.profile-inner { padding: 20px 21px 34px; }
.person-row { display: flex; align-items: center; gap: 15px; margin-bottom: 22px; }
.avatar-large { width: 69px; height: 69px; border-radius: 50%; font-size: 20px; flex-shrink: 0; }
.person-info { min-width: 0; }
.person-info h2 { font-size: 14px; margin: 0 0 7px; font-weight: 650; }
.person-info p { font-size: 11px; color: #8c929c; margin: 0; overflow-wrap: anywhere; }
.edit-btn, .primary-btn {
    margin-left: auto; background: var(--azul); color: white; border: 0;
    border-radius: 7px; padding: 9px 22px; font-size: 12px;
    box-shadow: 0 3px 8px rgba(67,133,255,.15);
}
.edit-btn:hover, .primary-btn:hover { background: #2e70ef; }
.fields { display: grid; grid-template-columns: 1fr 1fr; gap: 18px 22px; }
.field label { display: block; font-size: 12px; margin-bottom: 9px; color: #3c414b; }
.field input, .field select {
    display: block; width: 100%; height: 37px; padding: 0 13px;
    border: 1px solid transparent; border-radius: 5px;
    background: var(--fundo-campo); color: #626975; font-size: 12px; outline: none;
}
.field input:focus, .field select:focus { border-color: #9fc0ff; background: white; }
.field input:disabled, .field select:disabled { opacity: 1; color: #8a9099; cursor: default; }
.form-actions { display: none; justify-content: flex-end; gap: 9px; margin-top: 18px; }
.form-actions.show { display: flex; }
.secondary-btn { border: 1px solid #e3e8f1; background: white; color: #697181; padding: 9px 17px; border-radius: 7px; font-size: 12px; }
.section-title { font-size: 13px; margin: 23px 0 15px; font-weight: 650; }
.email-list { display: grid; gap: 12px; }
.email-item { display: flex; align-items: center; gap: 13px; min-width: 0; }
.email-icon { width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center; background: #edf4ff; color: var(--azul); flex-shrink: 0; }
.email-details { min-width: 0; }
.email-details p { margin: 0 0 5px; font-size: 12px; overflow-wrap: anywhere; }
.email-details small { color: #969ba5; font-size: 11px; }
.remove-email { margin-left: auto; border: 0; background: transparent; color: #a2a7b0; font-size: 18px; padding: 5px; }
.remove-email:hover { color: #dc4e59; }
.add-email-btn { margin-top: 20px; padding: 9px 16px; background: #edf4ff; border: 0; border-radius: 6px; color: var(--azul); font-size: 11px; }
.add-email-btn:hover { background: #dceaff; }
.notice { padding: 11px 14px; border-radius: 7px; margin-bottom: 15px; font-size: 12px; }
.notice.sucesso { color: #176b46; background: #eaf8f0; }
.notice.erro { color: #a82d38; background: #fff0f0; }
.empty { color: #969ba5; font-size: 12px; padding: 8px 0; }
.page-panel { display: none; padding: 28px; border: 1px solid #f0f1f4; border-radius: 8px; min-height: 300px; }
.page-panel h2 { margin-top: 0; font-size: 19px; }
.page-panel p { color: #777f8d; font-size: 13px; line-height: 1.7; }
.stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-top: 20px; }
.stat { padding: 20px; border: 1px solid #edf0f4; border-radius: 10px; background: #fafbfc; }
.stat strong { display: block; font-size: 23px; margin-bottom: 7px; }
.stat span { color: #8d929e; font-size: 12px; }
.toast { position: fixed; bottom: 20px; right: 20px; background: #273247; color: white; border-radius: 9px; padding: 13px 16px; font-size: 12px; box-shadow: 0 6px 25px #0002; display: none; z-index: 20; }
@media (max-width: 760px) {
    body { padding: 8px; }
    .app { min-height: calc(100vh - 16px); border-radius: 18px; }
    .sidebar { width: 52px; flex-basis: 52px; padding-top: 100px; gap: 7px; }
    .nav-btn { width: 43px; font-size: 18px; }
    .nav-btn::after { display: none !important; }
    main { padding: 18px 14px; }
    .topbar { align-items: flex-start; flex-direction: column; }
    .top-actions { width: 100%; }
    .search-wrap { flex: 1; width: auto; }
    .fields { grid-template-columns: 1fr; gap: 14px; }
    .profile-inner { padding: 18px 14px 26px; }
    .stat-grid { grid-template-columns: 1fr; }
}
@media (max-width: 430px) {
    .sidebar { width: 44px; flex-basis: 44px; }
    .nav-btn { width: 38px; }
    .person-row { gap: 10px; }
    .avatar-large { width: 55px; height: 55px; }
    .edit-btn { padding: 8px 13px; }
}
</style>
</head>
<body>
<div class="app">
    <aside class="sidebar" aria-label="Menu principal">
        <button class="nav-btn active" data-page="perfil" data-label="Meu perfil" title="Meu perfil">▦</button>
        <button class="nav-btn" data-page="dashboard" data-label="Dashboard" title="Dashboard">◷</button>
        <button class="nav-btn" data-page="estatisticas" data-label="Estatísticas" title="Estatísticas">♙</button>
        <button class="nav-btn" data-page="mensagens" data-label="Mensagens" title="Mensagens">▤</button>
        <button class="nav-btn" data-page="configuracoes" data-label="Configurações" title="Configurações">⚙</button>
    </aside>

    <main>
        <header class="topbar">
            <div class="welcome">
                <h1>Bem Vindo, <?= e(explode(' ', trim($perfil['nome']))[0] ?: 'Usuário') ?></h1>
                <p id="dataAtual">Carregando data...</p>
            </div>
            <div class="top-actions">
                <label class="search-wrap">
                    <span>⌕</span>
                    <input id="pesquisa" type="search" placeholder="Search" aria-label="Pesquisar nesta página">
                </label>
                <button class="icon-btn" id="notificacoes" type="button" title="Notificações" aria-label="Notificações">♧</button>
                <div class="avatar-small" title="<?= e($perfil['nome']) ?>"><?= e($iniciais ?: 'U') ?></div>
            </div>
        </header>

        <?php if ($mensagem !== ''): ?>
            <div class="notice <?= e($tipoMensagem) ?>" role="status"><?= e($mensagem) ?></div>
        <?php endif; ?>

        <section class="page-panel" id="painel-dashboard">
            <h2>Dashboard</h2>
            <p>Bem-vindo ao seu espaço pessoal. Aqui você pode acessar e administrar as informações do seu perfil.</p>
            <div class="stat-grid">
                <div class="stat"><strong><?= count($perfil['emails']) ?></strong><span>E-mails cadastrados</span></div>
                <div class="stat"><strong><?= e($perfil['pais'] ?: '—') ?></strong><span>País do perfil</span></div>
                <div class="stat"><strong><?= e($perfil['idioma'] ?: '—') ?></strong><span>Idioma selecionado</span></div>
            </div>
        </section>

        <section class="page-panel" id="painel-estatisticas">
            <h2>Estatísticas</h2>
            <p>Resumo das informações cadastradas na sua conta.</p>
            <div class="stat-grid">
                <div class="stat"><strong><?= count($perfil['emails']) ?></strong><span>Total de e-mails</span></div>
                <div class="stat"><strong><?= $perfil['nome'] !== '' ? 'Completo' : 'Pendente' ?></strong><span>Nome do perfil</span></div>
                <div class="stat"><strong><?= $perfil['pais'] !== '' ? 'Definido' : 'Pendente' ?></strong><span>País</span></div>
            </div>
        </section>

        <section class="page-panel" id="painel-mensagens">
            <h2>Mensagens</h2>
            <p id="mensagemVazia">Você não tem novas mensagens.</p>
            <p>As notificações e atualizações da sua conta aparecerão nesta área.</p>
        </section>

        <section class="page-panel" id="painel-configuracoes">
            <h2>Configurações</h2>
            <p>Personalize sua experiência de uso.</p>
            <label style="display:flex;gap:10px;align-items:center;font-size:13px;margin:20px 0">
                <input type="checkbox" id="modoCompacto"> Ativar modo compacto
            </label>
            <button class="secondary-btn" type="button" id="restaurar">Restaurar visual padrão</button>
        </section>

        <section id="painel-perfil">
            <div class="cover"></div>
            <div class="profile-card">
                <div class="profile-inner">
                    <div class="person-row">
                        <div class="avatar-large" id="avatarPrincipal"><?= e($iniciais ?: 'U') ?></div>
                        <div class="person-info">
                            <h2 id="nomeExibido"><?= e($perfil['nome']) ?></h2>
                            <p id="emailPrincipal"><?= e($perfil['emails'][0]['email'] ?? 'Nenhum e-mail cadastrado') ?></p>
                        </div>
                        <button class="edit-btn" type="button" id="editarBtn">Edit</button>
                    </div>

                    <form method="post" id="formPerfil">
                        <input type="hidden" name="acao" value="salvar_perfil">
                        <div class="fields">
                            <div class="field">
                                <label for="nome">Full Name</label>
                                <input id="nome" name="nome" type="text" value="<?= e($perfil['nome']) ?>" placeholder="Seu nome completo" disabled required>
                            </div>
                            <div class="field">
                                <label for="apelido">Nick Name</label>
                                <input id="apelido" name="apelido" type="text" value="<?= e($perfil['apelido']) ?>" placeholder="Seu apelido" disabled>
                            </div>
                            <div class="field">
                                <label for="genero">Gender</label>
                                <select id="genero" name="genero" disabled>
                                    <option value="">Selecione</option>
                                    <?php foreach (['Feminino','Masculino','Não informar','Outro'] as $opcao): ?>
                                    <option value="<?= e($opcao) ?>" <?= $perfil['genero'] === $opcao ? 'selected' : '' ?>><?= e($opcao) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label for="pais">Country</label>
                                <select id="pais" name="pais" disabled>
                                    <option value="">Selecione</option>
                                    <?php foreach (['Brasil','Portugal','Estados Unidos','Canadá','Angola','Moçambique','Outro'] as $opcao): ?>
                                    <option value="<?= e($opcao) ?>" <?= $perfil['pais'] === $opcao ? 'selected' : '' ?>><?= e($opcao) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label for="idioma">Language</label>
                                <select id="idioma" name="idioma" disabled>
                                    <?php foreach (['Português','English','Español','Français'] as $opcao): ?>
                                    <option value="<?= e($opcao) ?>" <?= $perfil['idioma'] === $opcao ? 'selected' : '' ?>><?= e($opcao) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label for="fuso">Time Zone</label>
                                <select id="fuso" name="fuso" disabled>
                                    <?php foreach (['America/Sao_Paulo','America/Manaus','America/Belem','Europe/Lisbon','America/New_York','UTC'] as $opcao): ?>
                                    <option value="<?= e($opcao) ?>" <?= $perfil['fuso'] === $opcao ? 'selected' : '' ?>><?= e($opcao) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions" id="acoesFormulario">
                            <button class="secondary-btn" type="button" id="cancelarBtn">Cancelar</button>
                            <button class="primary-btn" type="submit">Salvar alterações</button>
                        </div>
                    </form>

                    <h3 class="section-title">My email Address</h3>
                    <div class="email-list" id="listaEmails">
                        <?php if (empty($perfil['emails'])): ?>
                            <p class="empty">Nenhum e-mail cadastrado.</p>
                        <?php else: foreach ($perfil['emails'] as $item): ?>
                            <div class="email-item" data-search="<?= e(strtolower($item['email'])) ?>">
                                <div class="email-icon">✉</div>
                                <div class="email-details">
                                    <p><?= e($item['email']) ?></p>
                                    <small><?= e($item['quando']) ?></small>
                                </div>
                                <form method="post" class="form-remover-email" onsubmit="return confirm('Deseja remover este e-mail?')">
                                    <input type="hidden" name="acao" value="remover_email">
                                    <input type="hidden" name="email_id" value="<?= (int)$item['id'] ?>">
                                    <button class="remove-email" type="submit" title="Remover e-mail" aria-label="Remover e-mail">×</button>
                                </form>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                    <button class="add-email-btn" type="button" id="mostrarAdicionar">+ Add Email Address</button>
                    <form method="post" id="formAdicionarEmail" style="display:none;margin-top:14px;gap:8px;max-width:460px">
                        <input type="hidden" name="acao" value="adicionar_email">
                        <input type="email" name="novo_email" required placeholder="Digite o novo e-mail" style="min-width:0;flex:1;padding:10px;border:1px solid #e5e9f0;border-radius:6px;font-size:12px">
                        <button class="primary-btn" type="submit" style="margin-left:0">Adicionar</button>
                        <button class="secondary-btn" type="button" id="cancelarEmail">Cancelar</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>
<div class="toast" id="toast" role="status"></div>

<script>
const navButtons = document.querySelectorAll('.nav-btn');
const painelPerfil = document.getElementById('painel-perfil');
const paginas = {
    perfil: painelPerfil,
    dashboard: document.getElementById('painel-dashboard'),
    estatisticas: document.getElementById('painel-estatisticas'),
    mensagens: document.getElementById('painel-mensagens'),
    configuracoes: document.getElementById('painel-configuracoes')
};

function abrirPagina(nome) {
    Object.entries(paginas).forEach(([chave, elemento]) => {
        elemento.style.display = chave === nome ? (chave === 'perfil' ? 'block' : 'block') : 'none';
    });
    navButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.page === nome));
}
navButtons.forEach(btn => btn.addEventListener('click', () => abrirPagina(btn.dataset.page)));
abrirPagina('perfil');

const data = new Date();
document.getElementById('dataAtual').textContent = data.toLocaleDateString('pt-BR', {
    weekday: 'short', day: '2-digit', month: 'long', year: 'numeric'
});

const campos = document.querySelectorAll('#formPerfil input:not([type=hidden]), #formPerfil select');
const editarBtn = document.getElementById('editarBtn');
const acoesFormulario = document.getElementById('acoesFormulario');
const nomeInput = document.getElementById('nome');
const valoresOriginais = () => Array.from(campos).map(campo => campo.value);
let valoresAntes = valoresOriginais();

function definirEdicao(ativa) {
    campos.forEach(campo => campo.disabled = !ativa);
    acoesFormulario.classList.toggle('show', ativa);
    editarBtn.style.display = ativa ? 'none' : 'inline-block';
    if (ativa) nomeInput.focus();
}
editarBtn.addEventListener('click', () => {
    valoresAntes = valoresOriginais();
    definirEdicao(true);
});
document.getElementById('cancelarBtn').addEventListener('click', () => {
    campos.forEach((campo, i) => campo.value = valoresAntes[i]);
    definirEdicao(false);
});
document.getElementById('formPerfil').addEventListener('submit', (event) => {
    const nome = nomeInput.value.trim();
    if (!nome) {
        alert('Informe seu nome completo.');
        event.preventDefault();
        return;
    }
});

document.getElementById('mostrarAdicionar').addEventListener('click', () => {
    const form = document.getElementById('formAdicionarEmail');
    form.style.display = 'flex';
    form.querySelector('input[type=email]').focus();
});
document.getElementById('cancelarEmail').addEventListener('click', () => {
    document.getElementById('formAdicionarEmail').style.display = 'none';
});

document.getElementById('notificacoes').addEventListener('click', () => {
    mostrarToast('Você está em dia com as notificações da sua conta.');
});

function mostrarToast(texto) {
    const toast = document.getElementById('toast');
    toast.textContent = texto;
    toast.style.display = 'block';
    clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(() => toast.style.display = 'none', 3000);
}

document.getElementById('pesquisa').addEventListener('input', function() {
    const termo = this.value.toLocaleLowerCase('pt-BR').trim();
    document.querySelectorAll('.field').forEach(campo => {
        const texto = (campo.innerText + ' ' + (campo.querySelector('input,select')?.value || '')).toLocaleLowerCase('pt-BR');
        campo.style.display = !termo || texto.includes(termo) ? '' : 'none';
    });
    document.querySelectorAll('.email-item').forEach(item => {
        item.style.display = !termo || item.innerText.toLocaleLowerCase('pt-BR').includes(termo) ? 'flex' : 'none';
    });
    if (termo) abrirPagina('perfil');
});

document.getElementById('modoCompacto').addEventListener('change', function() {
    document.querySelector('.profile-inner').style.padding = this.checked ? '12px' : '';
    document.querySelectorAll('.fields').forEach(el => el.style.gap = this.checked ? '9px 14px' : '');
});
document.getElementById('restaurar').addEventListener('click', () => {
    document.getElementById('modoCompacto').checked = false;
    document.querySelector('.profile-inner').style.padding = '';
    document.querySelectorAll('.fields').forEach(el => el.style.gap = '');
    mostrarToast('Visual padrão restaurado.');
});
</script>
</body>
</html>
