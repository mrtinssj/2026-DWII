<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 — Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/publico.php
 * Autor      : Joice Martins
 */

session_start(); // verificar se há sessão (mas não exigir)
$logado = isset($_SESSION['usuario']);

$titulo_pagina = 'Página Pública';
$caminho_raiz  = '../';
$pagina_atual  = '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="text-align: center;">

    <h1 class="titulo-secao">🌐 Página Pública</h1>
    <p>Este conteúdo é visível para qualquer visitante, sem login.</p>

    <?php if ($logado): ?>
        <p>Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>!
            Você já está autenticado.</p>
        <a href="painel.php"
           style="background: #3ba34a; color: white; padding: 10px 24px;
                  border-radius: 6px; text-decoration: none;
                  font-weight: bold;">
            Ir ao Painel
        </a>
      <?php else: ?>
        <a href="login.php"
           style="background: #3b579d; color: white; padding: 10px 24px;
                  border-radius: 6px; text-decoration: none;
                  font-weight: bold;">
            🔐 Acessar Área Restrita
        </a>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>