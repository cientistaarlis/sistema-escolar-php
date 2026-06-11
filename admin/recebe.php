<?php
session_start();
include '../conexao.php';

if (!isset($_SESSION["logado"]) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome   = $_POST['nome_alu'];
    $cidade = $_POST['cidade_alu'];
    $tel    = $_POST['tel_alu'];
    $sexo   = $_POST['sexo_alu'];
    $email  = $_POST['email_alu'];

    $sql  = "INSERT INTO aluno (nome_alu, cidade_alu, tel_alu, sexo_al, email_alu) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação do SQL: " . $conexao->error);
    }

    $stmt->bind_param("sssss", $nome, $cidade, $tel, $sexo, $email);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "✅ Aluno cadastrado com sucesso!";
        header("Location: lista_alunos.php");
    } else {
        $_SESSION['erro'] = "❌ Erro ao cadastrar: " . $stmt->error;
        header("Location: formulario_aluno.php");
    }

    $stmt->close();
    $conexao->close();
}
?>
