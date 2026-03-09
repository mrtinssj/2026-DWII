<?php
$nome = "Joice Martins";
$pagina_atual = "sobre";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?php echo $nome; ?></title>

</head>
<body style="font-family: Arial, sans-serif; margin: 0; background: #f3f4f6;">
    
    <?php include 'includes/cabecalho.php' ?>

<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #3b579d;"> Sobre mim</h1>
    <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de Tecnico em Informatica
no IFPR de Ponta Grossa.</p>
<p>
    Oi, eu sou a Joice! Trabalho como gestora, social media e videomaker, e estou me aprofundando no mundo do tráfego pago para entender de verdade como criar campanhas que realmente funcionam. 
    Adoro transformar ideias em conteúdos visuais que chamam atenção e contam histórias de um jeito envolvente. 
    Fora do trabalho, a música está sempre comigo — sou super eclética e posso passar do pop ao rock, do eletrônico ao samba, dependendo do momento e do humor. 
    Para mim, música não é só trilha sonora, é combustível criativo que inspira tanto os meus projetos quanto o meu dia a dia.
</p>
<a> href="index.php"
    style="color: #3b579d; font-weight: bold;"> <- Voltar ao inicio</a>
</div>

<?php include 'includes/rodape.php' ?>

</body>
</html>