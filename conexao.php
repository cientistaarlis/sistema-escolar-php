<?php
$host    = "localhost";
$porta   = "3307";
$usuario = "root";
$senha   = "";
$banco   = "escola";

$conexao = new mysqli($host, $usuario, $senha, $banco, $porta);

if ($conexao->connect_error) {
    die("❌ Erro de conexão: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");
?>
