<?php
session_start();
include '../conexao.php';

if (!isset($_SESSION["logado"]) || $_SESSION['perfil'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id   = $_GET['id'];
    $sql  = "DELETE FROM aluno WHERE id_alu = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "✅ Aluno excluído com sucesso!";
    } else {
        $_SESSION['erro'] = "❌ Erro ao excluir: " . $conexao->error;
    }

    $stmt->close();
}

$conexao->close();
header("Location: lista_alunos.php");
exit;
?>
