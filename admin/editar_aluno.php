<?php
session_start();
include '../conexao.php';

if (!isset($_SESSION["logado"]) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$aluno = null;
if (isset($_GET['id'])) {
    $id   = $_GET['id'];
    $sql  = "SELECT * FROM aluno WHERE id_alu = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $aluno     = $resultado->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = $_POST['id_alu'];
    $nome   = $_POST['nome_alu'];
    $cidade = $_POST['cidade_alu'];
    $tel    = $_POST['tel_alu'];
    $sexo   = $_POST['sexo_alu'];
    $email  = $_POST['email_alu'];

    $sql  = "UPDATE aluno SET nome_alu=?, cidade_alu=?, tel_alu=?, sexo_al=?, email_alu=? WHERE id_alu=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $cidade, $tel, $sexo, $email, $id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "✅ Aluno atualizado com sucesso!";
        header("Location: lista_alunos.php");
    } else {
        $_SESSION['erro'] = "❌ Erro ao atualizar: " . $conexao->error;
    }
    $stmt->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>✏️ Editar Aluno</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            👤 Logado como: <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
            &nbsp;|&nbsp;<a href="../logout.php" style="color:#eb3349;">🚪 Sair</a>
        </div>

        <div class="header">
            <h2>✏️ Editar Dados do Aluno</h2>
        </div>

        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>

        <?php if ($aluno): ?>
            <form method="POST">
                <input type="hidden" name="id_alu" value="<?= $aluno['id_alu'] ?>">

                <div class="form-group">
                    <label>👨‍🎓 Nome do Aluno *</label>
                    <input type="text" name="nome_alu" value="<?= htmlspecialchars($aluno['nome_alu']) ?>" required>
                </div>
                <div class="form-group">
                    <label>🌆 Cidade *</label>
                    <input type="text" name="cidade_alu" value="<?= htmlspecialchars($aluno['cidade_alu']) ?>" required>
                </div>
                <div class="form-group">
                    <label>📞 Telefone *</label>
                    <input type="tel" name="tel_alu" value="<?= htmlspecialchars($aluno['tel_alu']) ?>" required>
                </div>
                <div class="form-group">
                    <label>⚧ Sexo *</label>
                    <select name="sexo_alu" required>
                        <option value="Masculino" <?= $aluno['sexo_al'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="Feminino"  <?= $aluno['sexo_al'] == 'Feminino'  ? 'selected' : '' ?>>Feminino</option>
                        <option value="Outro"     <?= $aluno['sexo_al'] == 'Outro'     ? 'selected' : '' ?>>Outro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>📧 Email *</label>
                    <input type="email" name="email_alu" value="<?= htmlspecialchars($aluno['email_alu']) ?>" required>
                </div>

                <button type="submit" class="btn-success">💾 Salvar Alterações</button>
                <a href="lista_alunos.php" class="btn-secondary">← Cancelar</a>
            </form>
        <?php else: ?>
            <div class="alert alert-error">Aluno não encontrado!</div>
            <a href="lista_alunos.php" class="btn-secondary">← Voltar</a>
        <?php endif; ?>

        <div class="footer">
            <p>&copy; <?= date('Y') ?> - Sistema Escolar</p>
        </div>
    </div>
</body>
</html>
