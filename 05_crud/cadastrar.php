<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo    : 05_crud/cadastrar.php
 * Descrição  : Exibe o formulário de cadastro e processa o INSERT
 */

// --- Proteção: apenas usuários autenticados ---
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// --- Dependências ---
require_once __DIR__ . '/includes/conexao.php';

$erro = '';

// Preserva os valores do formulário em caso de erro
$form = [
    'nome'         => '',
    'descricao'    => '',
    'tecnologias'  => '',
    'link_github'  => '',
    'ano'          => date('Y'),
];

// --- Processamento do POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Captura e sanitiza entradas
    $form['nome']         = trim($_POST['nome']         ?? '');
    $form['descricao']    = trim($_POST['descricao']    ?? '');
    $form['tecnologias']  = trim($_POST['tecnologias']  ?? '');
    $form['link_github']  = trim($_POST['link_github']  ?? '');
    $form['ano']          = (int) ($_POST['ano']        ?? date('Y'));

    // 2. Validação básica
    if ($form['nome'] === '') {
        $erro = 'O nome do projeto é obrigatório.';
    } elseif ($form['descricao'] === '') {
        $erro = 'A descrição é obrigatória.';
    } elseif ($form['tecnologias'] === '') {
        $erro = 'Informe ao menos uma tecnologia.';
    } elseif ($form['ano'] < 2000 || $form['ano'] > (int) date('Y') + 1) {
        $erro = 'Ano inválido.';
    }

    // 3. Persiste no banco se não há erros
    if ($erro === '') {
        $pdo = conectar();

        $sql = 'INSERT INTO projetos (nome, descricao, tecnologias, link_github, ano)
                VALUES (:nome, :descricao, :tecnologias, :link_github, :ano)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'         => $form['nome'],
            ':descricao'    => $form['descricao'],
            ':tecnologias'  => $form['tecnologias'],
            ':link_github'  => $form['link_github'] !== '' ? $form['link_github'] : null,
            ':ano'          => $form['ano'],
        ]);

        // 4. Redireciona via Sessão (Padronizado com o novo index.php)
        $_SESSION['flash'] = "Projeto \"{$form['nome']}\" cadastrado com sucesso!";
        header('Location: index.php');
        exit;
    }
}

$titulo_pagina = 'Cadastrar Projeto — Portfólio';
$caminho_raiz  = '../';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="max-width: 850px; margin: 0 auto; padding: 20px;">
    <h1 class="titulo-secao">➕ Cadastrar Novo Projeto</h1>

    <?php if ($erro): ?>
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #fecaca;">
            <p style="margin: 0; font-size: 14px;">🚫 <?php echo htmlspecialchars($erro); ?></p>
        </div>
    <?php endif; ?>

    <div class="card" style="padding: 35px; border-top: 5px solid #3b579d; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
        <form action="cadastrar.php" method="post" style="display: flex; flex-direction: column; gap: 20px;">

            <div>
                <label for="nome" style="display: block; font-weight: bold; margin-bottom: 8px; color: #374151;">
                    Nome do Projeto <span style="color: #cf1c21;">*</span>
                </label>
                <input type="text" id="nome" name="nome" 
                       value="<?php echo htmlspecialchars($form['nome']); ?>" 
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px;"
                       placeholder="Ex.: Sistema de Gestão Escolar" maxlength="120" required>
            </div>

            <div style="display: flex; gap: 25px; flex-wrap: wrap;">
                <div style="flex: 2; min-width: 300px;">
                    <label for="descricao" style="display: block; font-weight: bold; margin-bottom: 8px; color: #374151;">
                        Descrição <span style="color: #cf1c21;">*</span>
                    </label>
                    <textarea id="descricao" name="descricao" rows="9" 
                              style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; resize: none;" 
                              placeholder="Descreva as principais funcionalidades..." required><?php echo htmlspecialchars($form['descricao']); ?></textarea>
                </div>

                <div style="flex: 1; min-width: 250px; display: flex; flex-direction: column; gap: 15px;">
                    <div>
                        <label for="tecnologias" style="display: block; font-weight: bold; margin-bottom: 5px; color: #374151;">
                            Tecnologias <span style="color: #cf1c21;">*</span>
                        </label>
                        <input type="text" id="tecnologias" name="tecnologias" 
                               value="<?php echo htmlspecialchars($form['tecnologias']); ?>" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px;"
                               placeholder="PHP, MySQL, CSS" required>
                    </div>

                    <div>
                        <label for="ano" style="display: block; font-weight: bold; margin-bottom: 5px; color: #374151;">
                            Ano <span style="color: #cf1c21;">*</span>
                        </label>
                        <input type="number" id="ano" name="ano" 
                               value="<?php echo htmlspecialchars($form['ano']); ?>" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px;"
                               min="2000" max="<?php echo date('Y') + 1; ?>" required>
                    </div>

                    <div>
                        <label for="link_github" style="display: block; font-weight: bold; margin-bottom: 5px; color: #374151;">
                            GitHub <span style="color: #6b7280; font-weight: normal; font-size: 12px;">(opcional)</span>
                        </label>
                        <input type="url" id="link_github" name="link_github" 
                               value="<?php echo htmlspecialchars($form['link_github']); ?>" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px;"
                               placeholder="https://github.com/...">
                    </div>
                </div>
            </div>

            <div style="margin-top: 15px; display: flex; justify-content: flex-end; gap: 15px; border-top: 1px solid #f3f4f6; padding-top: 20px;">
                <a href="index.php" style="padding: 12px 20px; color: #6b7280; text-decoration: none; font-weight: bold;">Cancelar</a>
                <button type="submit" style="background: #3b579d; color: white; border: none; padding: 12px 30px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                    💾 Salvar Projeto
                </button>
            </div>
        </form>
    </div>

    <p style="margin-top: 20px; text-align: center;">
        <a href="index.php" style="color: #3b579d; text-decoration: none;">← Voltar para a lista</a>
    </p>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>