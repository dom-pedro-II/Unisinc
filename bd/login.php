<?php
// arquivo de configuração do banco de dados
require_once "conexao.php";
$tipo = $_GET['tipo'];

if ( $tipo == "aluno" ) {
   // Capturar dados do formulário
    $ra = $_POST['id'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar o login
    $sql = "SELECT * FROM Aluno WHERE RA = '$ra' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        header("Location: ../inicio_aluno.php?ra=" . $ra);
    } else {
        // Login falhou
        echo "Login falhou. Verifique seu RA e senha.";
    }
} else if ($tipo == 'professor'){
    // Capturar dados do formulário
    $id = $_POST['id'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar o login
    $sql = "SELECT * FROM Professor WHERE ID = '$id' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        header("Location: ../inicio_prof.php?ra=" . $id);
    } else {
        // Login falhou
        echo "Login falhou. Verifique seu ID e senha.";
    }
}

$conn->close();
?>
