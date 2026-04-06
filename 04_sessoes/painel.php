<?php
require_once __DIR__ . '/includes/auth.php';

requer_login();

$_SESSION['visitas'] = ($_SESSION['visitas'] ?? 0) + 1;

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">

    <?php if ($flash): ?>
        <div class="alerta-sucesso">
            <?php echo htmlspecialchars($flash); ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>📊 Painel</h2>

        <p><strong>Usuário:</strong> <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
        <p><strong>Login em:</strong> <?php echo $_SESSION['logado_em']; ?></p>
        <p><strong>Visitas nesta sessão:</strong> <?php echo $_SESSION['visitas']; ?></p>

        <p>
            <a href="perfil.php">Ir para Perfil</a>
        </p>
    </div>

    <div class="card" style="margin-top: 16px;">
        <h3>📊 Painel de controle</h3>
        <p>Este conteúdo só é visível para usuários autenticados.</p>
        <p>Nas próximas aulas este painel terá funcionalidades reais (CRUD).</p>
    </div>

    <p style="margin-top: 24px; text-align: center;">
        <a href="logout.php"
           style="background: #cf1c21; color: white; padding: 10px 24px;
                  border-radius: 6px; text-decoration: none; font-weight: bold;">
            🚪 Sair
        </a>
    </p>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>