<?php
/**
 * -------------------------------------------------------------
 * ARQUIVO : 02_formularios/contato.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula : 04 – PHP para Web: Formulários, GET e POST
 * Autor : Joice Martins
 * Conceitos : $_SERVER, REQUEST_METHOD, trim(), empty(), strlen()
 * -------------------------------------------------------------
 */

// — VARIÁVEIS DO TEMPLATE
$nome = "Joice";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Contato";


// — ESTADO INICIAL
$nome_visitante = '';
$assunto = '';
$email = '';
$mensagem = '';
$erros = [];


// — PROCESSAR SOMENTE SE VEIO POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // VALIDAÇÃO
    if (empty($nome_visitante)){
        $erros[] = 'O campo Nome é obrigatório.';
    }
    if (empty($email)) {
        $erros[] = 'O campo E-mail é obrigatório.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Informe um e-mail válido.';
    }

    if (empty($assunto)) {
        $erros[] = 'Selecione um assunto.';
    }

    if (empty($mensagem)){
        $erros[] = 'O campo Mensagem é obrigatório.';
    } elseif (strlen($mensagem) < 10){
        $erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
    } elseif (strlen($mensagem) > 500){
        $erros[] = "A mensagem deve ter no máximo 500 caracteres.";
    }

    // REDIRECIONAMENTO (PRG)
    if (empty($erros)) {
        header('Location: obrigado.php?nome=' . urlencode($nome_visitante));
        exit;
    }
}

?>

<?php include '../includes/cabecalho.php'; ?>

<div class="container">

<h1 class="titulo-secao">📬 Entre em Contato</h1>

<form class="form-container" action="contato.php" method="post">

<label>Nome *</label>
<input type="text" name="nome_visitante" value="<?= htmlspecialchars($nome_visitante) ?>">

<label>E-mail *</label>
<input type="email" name="email" value="<?= htmlspecialchars($email) ?>">

<label>Assunto:</label>
    <select name="assunto">
    <option value="">Selecione um assunto</option>
    <option value="Duvida"
    <?php if ($assunto === 'Duvida') echo 'selected'; ?>>
    ❓ Dúvida
    </option>

    <option value="Proposta de trabalho"
    <?php if ($assunto === 'Proposta de trabalho') echo 'selected'; ?>>
     👩🏻‍💻 Proposta de trabalho
    </option>

    <option value="Colaboracao"
    <?php if ($assunto === 'Colaboracao') echo 'selected'; ?>>
    ℹ️  Colaboração
    </option>

    <option value="Outro"
    <?php if ($assunto === 'Outro') echo 'selected'; ?>>
    ➡️  Outro
    </option>
</select>

<label>Mensagem *</label>
<textarea name="mensagem" rows="5"><?= htmlspecialchars($mensagem) ?></textarea>

<button type="submit">Enviar Mensagem</button>

</form>


<!-- Exibir erros -->
<?php if (!empty($erros)): ?>

<div class="alerta-erro">
<h3>⚠️ Corrija os erros abaixo:</h3>

<?php foreach ($erros as $erro): ?>
<p>• <?= htmlspecialchars($erro) ?></p>
<?php endforeach; ?>

</div>

<?php endif; ?>

</div>

<?php include '../includes/rodape.php'; ?>