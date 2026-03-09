
<?php
$nome = "Joice Martins";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "inicio";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio - <?php echo $nome; ?></title>
    <link rel="stylesheet" href="css/index.css">

</head>
<body>

<?php include 'includes/cabecalho.php' ?>
    
<div class="hero">
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> | <?php echo $curso; ?></p>
</div>

<div class="container">
    <h2>Bem Vindo ao meu Portfolio</h2>
    <p>Esta pagina foi gerada pelo PHP em:
        <strong><?php echo date("d/m/Y \à\s H:i:s"); ?></strong></p>
</div>


<?php include 'includes/rodape.php' ?>


</body>
</html>