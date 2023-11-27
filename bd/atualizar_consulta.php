<?php
// Inclua o arquivo de configuração do banco de dados
require_once "conexao.php";

$consultaID = $_GET['id'];
$ra =  $_GET['ra'];
$type = $_GET['type'];

// Lógica para atualizar a consulta quando o formulário for enviado
if ($type == 'atualizar'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $novaDataConsulta = $_POST['data_consulta'];
        $novaHoraConsulta = $_POST['hora_consulta'];

        // Consulta SQL para atualizar os dados da consulta
        $sqlAtualizarConsulta = "UPDATE Consulta SET DataConsulta = '$novaDataConsulta', HoraConsulta = '$novaHoraConsulta' WHERE ID = $consultaID";
        if ($conn->query($sqlAtualizarConsulta) === TRUE) {
            echo "Consulta atualizada com sucesso.";
            echo "<a href='../editar_consulta.php?consulta_id=$consultaID&ra=$ra'>Editar</a></li>";
            echo "<a href='../inicio_aluno.php?ra=$ra'>voltar para o inicio</a></li>";
        } else {
            echo "Erro ao atualizar a consulta: " . $conn->error;
        }
    }
    header("Location:../agenda.php?ra=$ra&s=s1");
    exit;
} else if ($type == "fim"){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $realizada = $_POST['realizada'];
        $atendimento = $_POST['atendimento'];
    
        // Consulta SQL para atualizar os dados da consulta
        $sqlAtualizarConsulta = "UPDATE Consulta SET atendimento = '$atendimento', realizada = '$realizada' WHERE ID = $consultaID";
        if ($conn->query($sqlAtualizarConsulta) === TRUE) {
            echo "Consulta atualizada com sucesso.";
            echo "<a href='../editar_consulta.php?consulta_id=$consultaID&ra=$ra'>Editar</a></li>";
            echo "<a href='../inicio_aluno.php?ra=$ra'>voltar para o inicio</a></li>";
        } else {
            echo "Erro ao atualizar a consulta: " . $conn->error;
        }
    }
    header("Location:../agenda.php?ra=$ra&s=s2");
    exit;
}else if ($type == 'desmarcar'){
    if (isset($_GET['id'])) {
        $consultaID = $_GET['id'];
    
        // Consulta SQL para excluir a consulta com base no ID da consulta
        $sqlExcluirConsulta = "DELETE FROM Consulta WHERE ID = $consultaID";
    
        if ($conn->query($sqlExcluirConsulta) === TRUE) {
            echo "Consulta excluída com sucesso.";
            echo "<a href='../inicio_aluno.php?ra=$ra'>voltar para o inicio</a>";
        } else {
            echo "Erro ao excluir a consulta: " . $conn->error;
        }
    } else {
        echo "ID da consulta não especificado.";
    }
    header("Location:../agenda.php?ra=$ra&s=s3");
    exit;
}

?>
