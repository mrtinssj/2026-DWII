<?php
/**
 * Arquivo : 05_crud/editar.php
 * Descrição: Busca dados existentes e processa o UPDATE
 */

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$erro = '';

// Se não passar ID válido, volta para a lista
if (!$id) {
    header('Location: index.php');
    exit;
}

// --- BUSCA OS DADOS ATUAIS ---
$sql = "SELECT * FROM projetos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$projeto) {
    header('Location: index.php');
    exit;
}

// --- PROCESSA O FORMULÁRIO (UPDATE) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $tecnologias = trim($_POST['tecnologias'] ?? '');
    $link_github = trim($_POST['link_github'] ?? '');
    $ano = (int) ($_POST['ano'] ?? date('Y'));

    if ($nome === '' || $descricao === '' || $tecnologias === '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        $sql = "UPDATE projetos SET 
                nome = :nome, 
                descricao = :descricao, 
                tecnologias = :tecnologias, 
                link_github = :link_github, 
                ano = :ano 
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'        => $nome,
            ':descricao'   => $descricao,
            ':tecnologias' => $tecnologias,
            ':link_github' => $link_github !== '' ? $link_github : null,
            ':ano'         => $ano,
            ':id'          => $id
        ]);

        header('Location: index.php?editado=ok');
        exit;
    }
}

$titulo_pagina = 'Editar Projeto';
$caminho_raiz  = '../';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>
<div class="container" style="max-width: 800px; margin: 0 auto;">
    <h1 class="titulo-secao">✏️ Editar Projeto</h1>

    <?php if ($erro): ?>
        <div class="alerta-erro" style="margin-bottom: 20px;"><p>🚫 <?php echo htmlspecialchars($erro); ?></p></div>
    <?php endif; ?>

    <div class="card" style="padding: 30px; border-top: 5px solid #059669;">
        <form method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            
            <div>
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #374151;">Nome do Projeto:</label>
                <input type="text" name="nome" 
                       value="<?php echo htmlspecialchars($projeto['nome']); ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
            </div>

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                
                <div style="flex: 2; min-width: 300px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #374151;">Descrição Detalhada:</label>
                    <textarea name="descricao" rows="8" 
                              style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; resize: vertical;" 
                              required><?php echo htmlspecialchars($projeto['descricao']); ?></textarea>
                </div>

                <div style="flex: 1; min-width: 250px; display: flex; flex-direction: column; gap: 15px;">
                    
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #374151;">Tecnologias (Stack):</label>
                        <input type="text" name="tecnologias" 
                               value="<?php echo htmlspecialchars($projeto['tecnologias']); ?>" 
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                    </div>

                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #374151;">Ano de Lançamento:</label>
                        <input type="number" name="ano" 
                               value="<?php echo htmlspecialchars($projeto['ano']); ?>" 
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" min="2000">
                    </div>

                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #374151;">Link GitHub:</label>
                        <input type="url" name="link_github" 
                               value="<?php echo htmlspecialchars($projeto['link_github']); ?>" 
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;" 
                               placeholder="https://github.com/...">
                    </div>
                </div>
            </div>

            <div style="margin-top: 10px; display: flex; justify-content: flex-end; gap: 15px; border-top: 1px solid #f3f4f6; padding-top: 20px;">
                <a href="index.php" style="padding: 10px 20px; color: #6b7280; text-decoration: none; font-weight: bold;">Cancelar</a>
                <button type="submit" style="background: #059669; color: white; border: none; padding: 10px 25px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                    💾 Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
    <p style="text-align: center;"><a href="index.php">← Cancelar</a></p>
</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>