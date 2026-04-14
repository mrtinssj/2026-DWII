<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 08 — CRUD Completo: Delete
 * Arquivo    : 05_crud/excluir.php
 */

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
// session_start() geralmente já está dentro do auth.php ou requer_login()
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$id = (int) ($_GET['id'] ?? 0);

// Se o ID for inválido, volta com mensagem de erro
if ($id <= 0) {
    $_SESSION['flash'] = "ID de projeto inválido.";
    header('Location: index.php');
    exit;
}

$pdo = conectar();
$stmt = $pdo->prepare('SELECT nome FROM projetos WHERE id = :id');
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

// Se o projeto não existir no banco
if (!$projeto) {
    $_SESSION['flash'] = "Projeto não encontrado.";
    header('Location: index.php');
    exit;
}

// Lógica de Exclusão (após o POST do formulário)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('DELETE FROM projetos WHERE id = :id');
    $stmt->execute([':id' => $id]);
    
    // Define a mensagem de sucesso e redireciona
    $_SESSION['flash'] = "O projeto \"{$projeto['nome']}\" foi excluído com sucesso!";
    header('Location: index.php');
    exit;
}

$titulo_pagina = 'Confirmar Exclusão';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    
    <div class="card" style="width: 100%; max-width: 480px; flex-direction: column; align-items: center; text-align: center; padding: 40px;">
        
        <h1 class="titulo-secao" style="margin-bottom: 20px;">🗑️ Excluir Projeto</h1>

        <p style="margin-bottom: 10px;">Você tem certeza que deseja excluir o projeto:</p>
        
        <h2 style="color: #3b579d; margin-bottom: 25px;">
            "<?php echo htmlspecialchars($projeto['nome']); ?>"
        </h2>

        <div style="background: #fef2f2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 30px; font-size: 14px; border: 1px solid #fecaca; width: 100%;">
            <strong>Atenção:</strong> Esta ação não pode ser desfeita e removerá todos os dados deste projeto.
        </div>

        <form action="excluir.php?id=<?php echo $id; ?>" method="post" style="width: 100%; margin: 0; padding: 0;">
            <div style="display: flex; justify-content: center; gap: 15px; width: 100%;">
                
                <button type="submit" style="flex: 1; background-color: #dc2626; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                    Sim, excluir
                </button>

                <a href="index.php" style="flex: 1; background-color: #6b7280; color: white; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                    Cancelar
                </a>
                
            </div>
        </form>

    </div>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>