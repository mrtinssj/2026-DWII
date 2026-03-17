<?php
/**
 * -------------------------------------------------------------
 * ARQUIVO : 02_formularios/obrigado.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula : 04 – PHP para Web: Formulários, GET e POST
 * Autor : Joice Martins
 * Conceitos : header() + exit (PRG), $_GET para parâmetros
 *              de confirmação, htmlspecialchars()
 * -------------------------------------------------------------
 *
 * Página de confirmação — destino do redirecionamento PRG.
 * Recebe o nome via GET apenas para exibição amigável.
 * Nenhum dado de formulário é processado aqui.
 */

// — VARIÁVEIS DO TEMPLATE
$nome = "Joice Martins";
$pagina_atual = "contato"; // mantém "contato" ativo no menu
$caminho_raiz = "../";
$titulo_pagina = "Obrigado";

// Recebe o nome enviado pelo header() em contato.php
// ?? 'visitante' garante fallback se alguém acessar direto
$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'visitante');

?>

<!-- cabecalho.php gera DOCTYPE, head, body, header e nav -->
<?php include '../includes/cabecalho.php'; ?>

<div class="container">

<div class="confirmacao">

<p class="confirmacao-icone">✅</p>

<h2 class="confirmacao-titulo">
Mensagem enviada com sucesso!
</h2>

<p class="confirmacao-texto">
Obrigado, <strong><?= $nome_visitante ?></strong> 🎉
</p>

<p class="confirmacao-texto">
Sua mensagem foi recebida. Retornarei em breve.
</p>

<div class="botoes">

<a href="../index.php" class="botao">
🏠 Voltar ao Portfólio
</a>

<a href="contato.php" class="botao-outline">
📮 Enviar outra mensagem
</a>

</div>

</div>

</div>

<?php include '../includes/rodape.php'; ?>