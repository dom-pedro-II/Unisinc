<?php
// Conexão com o banco de dados 
$server = "localhost";
$usuario = "root";
$senha = "";
$banco = "sga";

// Crie uma conexão
$conn = new mysqli($server, $usuario, $senha, $banco);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>