<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 07 — CRUD: Create e Read
 * Arquivo    : 05_crud/index.php
 */

// 1. Proteção: apenas usuários autenticados
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// 2. Dependências: IMPORTANTE vir antes de usar o $pdo
require_once __DIR__ . '/includes/conexao.php';
$pdo = conectar(); // Cria a conexão

// 3. Captura o termo de busca via GET
$busca = $_GET['busca'] ?? '';

// 4. Lógica de busca (B1)
if (!empty($busca)) {
    // Se tem busca, filtra pelo nome
    $sql = "SELECT * FROM projetos WHERE nome LIKE :termo ORDER BY criado_em DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':termo' => '%' . $busca . '%']);
} else {
    // Se não tem busca, traz todos
    $sql = "SELECT * FROM projetos ORDER BY criado_em DESC";
    $stmt = $pdo->query($sql);
}

// Recupera os resultados (uma única vez)
$projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Mensagem de sucesso após cadastro ---
$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';

$titulo_pagina = 'Meus Projetos — Portfólio';
$caminho_raiz  = '../';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>
    

<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
        <h1 class="titulo-secao" style="margin: 0;">📁 Meus Projetos</h1>
        
        <form method="GET" action="index.php" style="display: flex; gap: 8px;">
            <input type="text" name="busca" placeholder="Buscar por nome..." 
                   value="<?php echo htmlspecialchars($busca); ?>" 
                   style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" class="btn-primario">🔍</button>
        </form>

        <a href="cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
    </div>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">✅ Projeto cadastrado com sucesso!</p>
        </div>
    <?php endif; ?>

    <?php if (empty($projetos)): ?>
        <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 40px; margin: 0 0 12px;">📁</p>
            <p style="font-size: 16px; margin: 0 0 16px;">Nenhum projeto encontrado.</p>
            <a href="cadastrar.php" class="btn-primario">➕ Cadastrar projeto</a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($projetos as $projeto): ?>
    <div class="card" style="display: flex; flex-direction: column; padding: 20px; margin-bottom: 25px; border-left: 5px solid #3b579d; transition: transform 0.2s;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="margin: 0; font-size: 20px; color: #1f2937;">
                <a href="detalhe.php?id=<?php echo $projeto['id']; ?>" style="text-decoration: none; color: #3b579d;">
                    <?php echo htmlspecialchars($projeto['nome']); ?>
                </a>
            </h3>
            <span style="background: #e5e7eb; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; color: #4b5563;">
                📅 <?php echo htmlspecialchars($projeto['ano']); ?>
            </span>
        </div>

        <div style="display: flex; gap: 25px; align-items: stretch;">
            
            <div style="flex: 3;">
                <p style="margin: 0; font-size: 15px; color: #4b5563; line-height: 1.6; text-align: justify;">
                    <?php echo htmlspecialchars($projeto['descricao']); ?>
                </p>
            </div>

            <div style="flex: 1; border-left: 1px dashed #ccc; padding-left: 20px; display: flex; flex-direction: column; justify-content: space-between; min-width: 180px;">
                <div>
                    <strong style="display: block; font-size: 12px; text-transform: uppercase; color: #9ca3af; margin-bottom: 5px;">Tecnologias</strong>
                    <p style="margin: 0; font-size: 13px; color: #374151; font-weight: 500;">
                        <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                    </p>
                </div>

                <div style="margin-top: 15px;">
                    <?php if ($projeto['link_github']): ?>
                        <a href="<?php echo htmlspecialchars($projeto['link_github']); ?>" 
                           target="_blank" rel="noopener noreferrer" 
                           style="display: inline-block; font-size: 13px; color: #fff; background: #24292e; padding: 6px 12px; border-radius: 4px; text-decoration: none;">
                           GitHub
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f3f4f6; display: flex; justify-content: flex-end; gap: 20px;">
            <a href="editar.php?id=<?php echo $projeto['id']; ?>" 
               style="color: #059669; font-size: 14px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 4px;">
               <span>✏️</span> Editar
            </a>
            
            <a href="excluir.php?id=<?php echo $projeto['id']; ?>" 
               style="color: #dc2626; font-size: 14px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 4px;"
               onclick="return confirm('Deseja excluir: <?php echo addslashes($projeto['nome']); ?>?')">
               <span>🗑️</span> Excluir
            </a>
        </div>
    </div>
<?php endforeach; ?>
        </div>
        <p style="margin-top: 16px; font-size: 14px; color: #6b7280; text-align: right;">
            <?php echo count($projetos); ?> projeto(s) encontrado(s)
        </p>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>