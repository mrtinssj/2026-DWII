<?php
/*
ARQUIVO: index.php (raiz do repositório 2026-DWII)
Disciplina: Desenvolvimento Web II
Aula: Hub de navegação do repositório
Conceitos: array associativo, foreach, date(), htmlspecialchars()
*/

// VARIÁVEIS
$nome = "Joice Martins";
$subtitulo = "Repositório 2026 - Desenvolvimento Web II";

// CATÁLOGO DE AULAS
$aulas = [

[
"numero" => "00",
"nome" => "Apresentação Pessoal",
"descricao" => "Página estática com HTML e CSS com foto de perfil e layout responsivo.",
"link" => "00_apresentacao/index.html",
"icone" => "👤",
"cor" => "#667280",
"conceitos" => "HTML semântico, CSS Flexbox, responsividade"
],

[
"numero" => "03",
"nome" => "Portfólio Dinâmico com PHP",
"descricao" => "Mini-site de portfólio com variáveis, includes e menu dinâmico.",
"link" => "01_php-intro/index.php",
"icone" => "💻",
"cor" => "#3b579d",
"conceitos" => "Variáveis, echo, include, foreach, operador ternário"
],

[
"numero" => "04",
"nome" => "Formulário de Contato",
"descricao" => "Formulário com validação no servidor, proteção XSS e padrão PRG.",
"link" => "02_formularios/contato.php",
"icone" => "📩",
"cor" => "#3ba34a",
"conceitos" => "$_POST, validação, htmlspecialchars(), header() + exit"
]

];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($subtitulo); ?></title>

<link rel="stylesheet" href="includes/index.css">
</head>

<body>

<header>
<h1><?php echo htmlspecialchars($nome); ?></h1>
<p><?php echo htmlspecialchars($subtitulo); ?></p>
</header>

<div class="container">

<h2 class="secao">Projetos por Aula</h2>

<?php foreach ($aulas as $aula): ?>

<div class="card-aula" style="border-left-color: <?php echo $aula['cor']; ?>;">

<div class="icone">
<?php echo $aula['icone']; ?>
</div>

<div class="conteudo">

<span class="badge">
Aula <?php echo htmlspecialchars($aula['numero']); ?>
</span>

<h3 style="color: <?php echo $aula['cor']; ?>;">
<?php echo htmlspecialchars($aula['nome']); ?>
</h3>

<p>
<?php echo htmlspecialchars($aula['descricao']); ?>
</p>

<span class="conceitos">
🔑 <?php echo htmlspecialchars($aula['conceitos']); ?>
</span>

<br>

<a href="<?php echo htmlspecialchars($aula['link']); ?>"
class="btn"
style="background: <?php echo $aula['cor']; ?>;">
Abrir →
</a>

</div>
</div>

<?php endforeach; ?>

<p style="text-align:right; font-size:13px; color:#9ca3af;">
Gerado em: <?php echo date("d/m/Y \à\s H:i:s"); ?>
</p>

</div>

<footer>
<?php echo htmlspecialchars($nome); ?>
&copy; <?php echo date("Y"); ?>
| Desenvolvido com PHP | IFPR – Ponta Grossa
</footer>

</body>
</html>