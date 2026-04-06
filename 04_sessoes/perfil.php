<?php
require_once __DIR__ . '/includes/auth.php';

requer_login();

$titulo_pagina = 'Perfil do Usuário';
$caminho_raiz  = '../';
$pagina_atual  = '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="max-width: 500px;">

    <div class="card perfil-card">

    <div class="perfil-topo">
        <div class="perfil-avatar">👤</div>
        <h2>Perfil do Usuário</h2>
    </div>

    <div class="perfil-info">
        <p><strong>Usuário:</strong><br>
        <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>

        <p><strong>Login realizado em:</strong><br>
        <?php echo $_SESSION['logado_em']; ?></p>
    </div>

    <a href="painel.php" class="btn-voltar">
        ⬅ Voltar ao painel
    </a>

</div>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>