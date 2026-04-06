<?php
require_once __DIR__ . '/includes/auth.php';

iniciar_sessao();
redirecionar_se_logado();

$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA   = 'dwii2026';

$erro = '';
$login = '';

$_SESSION['tentativas'] = $_SESSION['tentativas'] ?? 0;

if (!empty($_SESSION['bloqueado_ate']) && time() < $_SESSION['bloqueado_ate']) {
    $erro = 'Muitas tentativas. Tente novamente em alguns segundos.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (!empty($_SESSION['bloqueado_ate']) && time() < $_SESSION['bloqueado_ate']) {
        // bloqueado

    } elseif ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {

        session_regenerate_id(true);

        $_SESSION['usuario'] = $login;
        $_SESSION['logado_em'] = date('d/m/Y H:i');
        $_SESSION['visitas'] = 0;

        $_SESSION['flash'] = "Bem-vindo, $login!";

        $_SESSION['tentativas'] = 0;

        header('Location: painel.php');
        exit;

    } else {
        $_SESSION['tentativas']++;

        if ($_SESSION['tentativas'] >= 3) {
            $_SESSION['bloqueado_ate'] = time() + 60;
        }

        $erro = 'Usuário ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="/css/style.css">
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="max-width: 420px;">
<div class="form-container">

<h1 class="titulo-secao" style="text-align: center; font-size: 22px;">
    🔐 Área Restrita
</h1>

<?php if (!empty($erro)): ?>
    <div class="alerta-erro">
        ⛔ <?php echo htmlspecialchars($erro); ?>
    </div>
<?php endif; ?>

<form action="login.php" method="post">
    <label>Usuário:</label>
    <input type="text"
           name="usuario"
           value="<?php echo htmlspecialchars($login); ?>"
           autocomplete="username">

    <label>Senha:</label>
    <input type="password"
           name="senha"
           autocomplete="current-password">

    <button type="submit">Entrar</button>
</form>

<p style="text-align: center; margin-top: 20px;">
    <a href="../index.php">← Voltar ao início</a>
</p>

</div>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>