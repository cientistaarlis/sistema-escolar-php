<?php
session_start();

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
    <title>📝 Cadastro de Aluno</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            👤 Logado como: <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
            &nbsp;|&nbsp;<a href="../logout.php" style="color:#eb3349;">🚪 Sair</a>
        </div>

        <div class="header">
            <h2>📝 Cadastro de Aluno</h2>
        </div>

        <form action="recebe.php" method="POST">
            <div class="form-group">
                <label for="nome">👨‍🎓 Nome do Aluno *</label>
                <input type="text" id="nome" name="nome_alu" placeholder="Ex: João Silva" required autofocus>
            </div>
            <div class="form-group">
                <label for="cidade">🌆 Cidade do Aluno *</label>
                <input type="text" id="cidade" name="cidade_alu" placeholder="Ex: São Paulo" required>
            </div>
            <div class="form-group">
                <label for="tel">📞 Telefone do Aluno *</label>
                <input type="tel" id="tel" name="tel_alu" placeholder="Ex: (11) 99999-9999" required>
            </div>
            <div class="form-group">
                <label for="sexo">⚧ Sexo do Aluno *</label>
                <select id="sexo" name="sexo_alu" required>
                    <option value="">Selecione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">📧 Email do Aluno *</label>
                <input type="email" id="email" name="email_alu" placeholder="Ex: joao@email.com" required>
            </div>

            <button type="submit" class="btn-success">🎯 Cadastrar Aluno</button>
            <a href="site_escola.php" class="btn-secondary">← Voltar</a>
        </form>

        <div class="footer">
            <p>&copy; <?= date('Y') ?> - Sistema Escolar</p>
        </div>
    </div>
</body>
</html>
