<?php
session_start();

// Se já estiver logado, redireciona conforme perfil
if (isset($_SESSION["logado"])) {
    if ($_SESSION['perfil'] == 'admin') {
        header("Location: admin/site_escola.php");
    } else {
        header("Location: aluno/index.php");
    }
    exit;
}

include 'conexao.php';

$erro = "";

if (isset($_POST['login']) && isset($_POST['senha'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Busca o usuário no banco de dados
    $sql = "SELECT * FROM login WHERE login_usu = ? AND senha_usu = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $login, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Salva dados na sessão
        $_SESSION['logado']  = true;
        $_SESSION['usuario'] = $usuario['login_usu'];
        $_SESSION['perfil']  = $usuario['perfil_usu'];

        // Redireciona conforme o perfil
        if ($usuario['perfil_usu'] == 'admin') {
            header("Location: admin/site_escola.php");
        } else {
            header("Location: aluno/index.php");
        }
        exit;
    } else {
        $erro = "❌ Login ou senha incorretos!";
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>🔐 Login - Sistema Escolar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
        }
        .login-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 8px;
            font-size: 24px;
        }
        .login-box p {
            text-align: center;
            color: #888;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        button:hover { opacity: 0.9; }
        .erro {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ffcdd2;
        }

    </style>
</head>
<body>
    <div class="login-box">
        <h2>🏫 Sistema Escolar</h2>
        <p>Faça login para continuar</p>

        <?php if ($erro): ?>
            <div class="erro"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>👤 Login:</label>
                <input type="text" name="login" placeholder="Digite seu login" required autofocus>
            </div>
            <div class="form-group">
                <label>🔒 Senha:</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Entrar →</button>
        </form>


    </div>
</body>
</html>