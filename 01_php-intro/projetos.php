<?php
$nome = "Joice Martins";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "projetos";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<section class="hero">
    
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Meus Projetos</h2>

    <p>Ao longo do curso Técnico em Informática no IFPR, venho colocando em prática o que aprendo por meio do desenvolvimento de diferentes projetos, que refletem minha evolução na área de programação e web.

Um dos trabalhos foi a criação de uma página pessoal, construída com HTML e CSS, onde trabalhei a organização do conteúdo, uso de estrutura semântica e adaptação para diferentes telas.

Também desenvolvi um portfólio com PHP, utilizando includes e variáveis para integrar as páginas, o que permitiu uma melhor organização do código e reaproveitamento de componentes.

Além desses projetos, realizei diversos exercícios e atividades práticas voltadas à lógica de programação e desenvolvimento web, fundamentais para fortalecer meu raciocínio e entender, de forma mais completa, o funcionamento das aplicações.</p><br>
     <h2>Sistema de Pedido para Cantina</h2>

     <p>Sistema voltado para facilitar pedidos no intervalo escolar, com foco em organização, agilidade e melhor experiência para alunos e cantina.</p><br>

    <h2>Sistema de Controle de Frequência</h2>

    <p>Aplicação desenvolvida para registro e acompanhamento da presença de alunos, com foco em organização e gestão de dados.</p><br>

    <h2>Portfólio Web</h2>

    <p>Desenvolvimento de um site pessoal para apresentar minha trajetória, habilidades e projetos, utilizando HTML, CSS e estruturação de páginas.</p><br>

    <h2>Projetos Acadêmicos em Desenvolvimento Web</h2>
    
    <p>Criação de páginas e aplicações simples utilizando HTML, CSS e PHP, com foco no aprendizado prático e na compreensão do funcionamento de sistemas.</p><br>

</main>

<?php include '../includes/rodape.php'; ?>