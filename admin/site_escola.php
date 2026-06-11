<?php
session_start();

// Verifica se está logado E se é admin
if (!isset($_SESSION["logado"]) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>🏫 Painel Admin - Sistema Escolar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            👤 Logado como: <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
            &nbsp;|&nbsp;🔑 Perfil: <strong>Administrador</strong>
            &nbsp;|&nbsp;<a href="../logout.php" style="color:#eb3349;">🚪 Sair</a>
        </div>

        <div class="header">
            <h2>🏫 Painel Administrativo</h2>
            <p>Bem-vindo ao sistema de gestão escolar</p>
        </div>

        <div class="menu">
            <a href="formulario_aluno.php" class="menu-item">
                <h3>📝 Cadastro de Aluno</h3>
                <p>Cadastrar novos alunos no sistema</p>
            </a>
            <a href="lista_alunos.php" class="menu-item">
                <h3>👥 Visualizar Alunos</h3>
                <p>Ver todos os alunos cadastrados</p>
            </a>
            <a href="lista_alunos.php" class="menu-item">
                <h3>✏️ Alterar Dados do Aluno</h3>
                <p>Editar informações dos alunos</p>
            </a>
            <a href="lista_alunos.php" class="menu-item">
                <h3>🗑️ Excluir Alunos</h3>
                <p>Remover alunos do sistema</p>
            </a>
        </div>

        <div class="footer">
            <p>&copy; <?= date('Y') ?> - Sistema Escolar</p>
        </div>
    </div>
</body>
</html>
