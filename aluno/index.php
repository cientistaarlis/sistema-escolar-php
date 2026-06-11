<?php
session_start();
include '../conexao.php';

// Verifica se está logado (qualquer perfil pode acessar)
if (!isset($_SESSION["logado"])) {
    header("Location: ../index.php");
    exit;
}

// Busca lista de alunos para exibição pública
$sql       = "SELECT nome_alu, cidade_alu, email_alu FROM aluno ORDER BY nome_alu";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>🎓 Área do Aluno</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            👤 Logado como: <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
            &nbsp;|&nbsp;🎓 Perfil: <strong>Aluno</strong>
            &nbsp;|&nbsp;<a href="../logout.php" style="color:#eb3349;">🚪 Sair</a>
        </div>

        <div class="header">
            <h2>🎓 Área do Aluno</h2>
            <p>Bem-vindo à área pública do sistema escolar</p>
        </div>

        <div class="table-container">
            <h3 style="margin-bottom:15px; color:#555;">📋 Alunos Matriculados</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while ($aluno = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($aluno['nome_alu']) ?></td>
                                <td><?= htmlspecialchars($aluno['cidade_alu']) ?></td>
                                <td><?= htmlspecialchars($aluno['email_alu']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align:center;">Nenhum aluno cadastrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>&copy; <?= date('Y') ?> - Sistema Escolar</p>
        </div>
    </div>
</body>
</html>
