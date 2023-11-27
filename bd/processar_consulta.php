<?php
require_once "conexao.php";

$aluno1RA = $_GET['ra1'];
$aluno2RA = $_GET['ra2'];
$dataConsulta = $_GET['data'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pacienteID']) && isset($_POST['horaConsulta'])) {
        $pacienteID = $_POST['pacienteID'];
        $horaConsulta = $_POST['horaConsulta'];
            	
        // Verificar se o horário escolhido ainda está disponível
        $consultaHorario = "SELECT * FROM Consulta WHERE DataConsulta = '$dataConsulta' AND HoraConsulta = '$horaConsulta' AND (Aluno1RA = '$aluno1RA' OR Aluno2RA = '$aluno2RA')";
        $resultadoHorario = mysqli_query($conn, $consultaHorario);

        if (mysqli_num_rows($resultadoHorario) == 0) {
            // O horário está disponível, podemos inserir a consulta no banco de dados
            $inserirConsulta = "INSERT INTO Consulta (DataConsulta, HoraConsulta, PacienteID, Aluno1RA, Aluno2RA) VALUES ('$dataConsulta', '$horaConsulta', $pacienteID, '$aluno1RA', '$aluno2RA')";

            if (mysqli_query($conn, $inserirConsulta)) {
                // A consulta foi marcada com sucesso

                // Agora, remova o paciente da fila
                $removerDaFila = "DELETE FROM Fila WHERE PacienteID = $pacienteID";
                if (mysqli_query($conn, $removerDaFila)) {
                    // O paciente foi removido da fila com sucesso
                    header("Location: ../agenda.php?ra=$aluno1RA"); // Redirecionar para uma página de sucesso
                } else {
                    echo "Erro ao remover o paciente da fila: " . mysqli_error($conn);
                }
            } else {
                echo "Erro ao inserir a consulta: " . mysqli_error($conn);
            }
        } else {
            echo "O horário escolhido não está mais disponível. Por favor, escolha outro horário.";
        }
    } else {
        echo "Parâmetros ausentes. Certifique-se de preencher todos os campos necessários.";
    }
} else {
    echo "Método de requisição inválido. Esta página deve ser acessada via POST.";
}
?>
