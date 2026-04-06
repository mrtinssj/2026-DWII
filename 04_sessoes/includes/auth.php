<?php
function iniciar_sessao()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function requer_login(): void
{
    iniciar_sessao();

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
}

function redirecionar_se_logado(): void
{
    iniciar_sessao();

    if (isset($_SESSION['usuario'])) {
        header('Location: painel.php');
        exit;
    }
}

function usuario_logado(): string
{
    return $_SESSION['usuario'] ?? '';
}
?>