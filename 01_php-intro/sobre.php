<?php
$nome = "Joice Martins";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "sobre";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<section class="hero">
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Sobre mim</h2>

    <p>Sou Joice Martins, estudante do curso Técnico em Informática no IFPR. Minha jornada na tecnologia começou dentro da escola, mas foi além da sala de aula que comecei a me interessar de verdade pelo que dá pra criar com programação.</p>

<p>Hoje, venho construindo minha base em desenvolvimento web, trabalhando com HTML, CSS, PHP e lógica de programação. Mais do que aprender códigos, busco entender como as coisas funcionam por trás e como transformar ideias em algo que realmente funcione na prática.</p>

<p>O que mais me motiva é justamente essa possibilidade de criar, testar e evoluir. Quero continuar me desenvolvendo na área, aprendendo novas tecnologias e explorando diferentes formas de construir soluções digitais.</p>

<p>Fora da parte técnica, também gosto de tirar ideias do papel, desenvolver projetos próprios e estar sempre aprendendo algo novo que me ajude a crescer, tanto pessoal quanto profissionalmente.</p>
    
</main>

<?php include '../includes/rodape.php'; ?>