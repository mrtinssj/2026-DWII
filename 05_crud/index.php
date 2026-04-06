<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 07 — CRUD: Create e Read
 * Arquivo    : 05_crud/index.php
 * Autor      : Joice Martins
 * Data       : 06/04/26
 * Descrição  : Lista todos os projetos cadastrados no banco
 * (Read)
 */

// --- Proteção: apenas usuários autenticados ---
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();



// --- Dependências ---
require_once __DIR__ . '/includes/conexao.php';

    // --- Busca todos os projetos ordenados pelo mais recente ---
    $pdo = conectar();
    $stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
    $projetos = $stmt->fetchAll();

    // --- Mensagem de sucesso após cadastro ---
    $cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';

    $titulo_pagina = 'Meus Projetos — Portfólio';
    $caminho_raiz  = '../';
    $pagina_atual  = '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
        <h1 class="titulo-secao" style="margin: 0;">📁 Meus Projetos</h1>
        <a href="cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
    </div>

<?php if ($cadastroOk): ?>
    <div class="alerta-sucesso">
        <p style="margin: 0;">✅ Projeto cadastrado com 
        sucesso!</p>
    </div>
<?php endif; ?>

<?php if (empty($projetos)): ?>
    <div class="card" style="text-align: center; padding: 
    40px 20px; color: #6b7280;">
        <p style="font-size: 40px; margin: 0 0 12px;">📁</p>
        <p style="font-size: 16px; margin: 0 0 16px;">Nenhum 
        projeto cadastrado ainda.</p>
        <a href="cadastrar.php" class="btn-primario">➕ 
        Cadastrar o primeiro projeto</a>
    </div>

<?php else: ?>
    <div style="display: grid; grid-template-columns: repeat
    (auto-fill, minmax(280px, 1fr)); gap: 20px;">
        <?php foreach ($projetos as $projeto): ?>
            <div class="card">
                <h3 style="margin: 0 0 8px; color: #3b579d; 
                font-size: 17px;">
                    <?php echo htmlspecialchars($projeto
                    ['nome']); ?>
                </h3>

                <p style="margin: 0 0 10px; font-size: 14px; 
                color: #374151; line-height: 1.6;">
                    <?php echo htmlspecialchars($projeto
                    ['descricao']); ?>
                </p>

                <p style="margin: 0 0 6px; font-size: 13px; 
                color: #6b7280;">
                    🛠️ <?php echo htmlspecialchars($projeto
                    ['tecnologias']); ?>
                </p>

                <p style="margin: 0 0 12px; font-size: 13px; 
                color: #6b7280;">
                    📅 <?php echo htmlspecialchars($projeto
                    ['ano']); ?>
                </p>

                <?php if ($projeto['link_github']): ?>
                    <a href="<?php echo htmlspecialchars
                    ($projeto['link_github']); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="btn-secundario">🔗 Ver no 
                        GitHub</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
        <p style="margin-top: 16px; font-size: 14px; color: #6b7280; text-align: right;">
        <?php echo count($projetos); ?> projeto(s) cadastrado(s)
    </p>
<?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>