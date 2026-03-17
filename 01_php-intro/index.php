<?php
$nome = "Joice Martins";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$caminho_raiz = "../";
$pagina_atual = "inicio";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<section class="hero">
    <img src="../imgs/fotoJoice.jpeg" alt="Foto de Joice" class="foto" />
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Início</h2>
    <p>Seja bem-vindo(a)! Aqui você vai conhecer mais sobre mim, minha caminhada até aqui, as habilidades que venho desenvolvendo e alguns dos projetos que fazem parte da minha trajetória na área de desenvolvimento web.</p>
</main>

<?php include '../includes/rodape.php'; ?>