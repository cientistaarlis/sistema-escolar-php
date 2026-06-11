<?php
session_start();
include '../conexao.php';

if (!isset($_SESSION["logado"]) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$sql       = "SELECT * FROM aluno ORDER BY nome_alu";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>👥 Lista de Alunos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            👤 Logado como: <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
            &nbsp;|&nbsp;<a href="../logout.php" style="color:#eb3349;">🚪 Sair</a>
        </div>

        <div class="header">
            <h2>👥 Lista de Alunos Cadastrados</h2>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                        <th>Sexo</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while ($aluno = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= $aluno['id_alu'] ?></td>
                                <td><?= htmlspecialchars($aluno['nome_alu']) ?></td>
                                <td><?= htmlspecialchars($aluno['cidade_alu']) ?></td>
                                <td><?= htmlspecialchars($aluno['tel_alu']) ?></td>
                                <td><?= htmlspecialchars($aluno['sexo_al']) ?></td>
                                <td><?= htmlspecialchars($aluno['email_alu']) ?></td>
                                <td>
                                    <a href="editar_aluno.php?id=<?= $aluno['id_alu'] ?>" class="btn btn-warning">✏️ Editar</a>
                                    <a href="excluir_aluno.php?id=<?= $aluno['id_alu'] ?>" class="btn btn-danger"
                                       onclick="return confirm('Deseja realmente excluir este aluno?')">🗑️ Excluir</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">Nenhum aluno cadastrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <a href="site_escola.php" class="btn-secondary">← Voltar ao Menu</a>
            <a href="formulario_aluno.php" class="btn-success">➕ Novo Aluno</a>
        </div>
    </div>
</body>
</html>
