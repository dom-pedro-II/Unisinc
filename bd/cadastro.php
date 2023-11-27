<?php
// Inclua o arquivo de configuração do banco de dados
require_once "conexao.php";
$type = $_GET['type'];
$ra2 = $_GET['ra'];



if ($type == 'aluno') {
    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta os dados do formulário
        $ra = $_POST["ra"];
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $materias = $_POST["materias"];

        // Insira os dados do aluno na tabela "Aluno"
        $sql = "INSERT INTO Aluno (RA, Nome, senha) VALUES ('$ra', '$nome','$senha')";
        if ($conn->query($sql) === TRUE) {
            $alunoID = $conn->insert_id;

            // Insira as matérias em que o aluno está matriculado na tabela "Aluno_Materia"
            foreach ($materias as $materiaID) {
                $sql = "INSERT INTO Aluno_Materia (AlunoID, MateriaID) VALUES ('$ra', '$materiaID')";
                $conn->query($sql);
            }

            echo "Aluno cadastrado com sucesso!$ra2 ";
        } else {
            echo "Erro ao cadastrar o aluno: " . $conn->error;
        }
    }
    header("Location:../inicio_prof.php?ra=$ra2&s=s1");
    exit;
} else if ($type == "paciente") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $tel2 = $_POST['tel2'];
        $materiaID = $_POST['materias'];
    
        // Inserir os dados na tabela Paciente
        $sql_paciente = "INSERT INTO Paciente (Nome, email, tel, tel2, MateriaID) VALUES ('$nome', '$email', '$tel', '$tel2', '$materiaID');";
        
        if ($conn->query($sql_paciente) === TRUE) {
            echo "Paciente cadastrado com sucesso!";
            
            // Recupere o ID do paciente inserido
            $pacienteID = $conn->insert_id;
    
            // Insira o paciente na fila
            $sql_fila = "INSERT INTO Fila (PacienteID) VALUES ('$pacienteID');";
            
            if ($conn->query($sql_fila) === TRUE) {
                echo "Paciente registrado na fila com sucesso!";
            } else {
                echo "Erro ao registrar o paciente na fila: " . $conn->error;
            }
        } else {
            echo "Erro ao cadastrar o paciente: " . $conn->error;
        }
    }
    header("Location:../inicio_prof.php?ra=$ra2&s=s2");
} else if ($type == "professor") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta os dados do formulário
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $materias = $_POST["materias"];
    
        // Insira os dados do aluno na tabela "Aluno"
        $sql = "INSERT INTO professor (id, Nome, senha) VALUES ('$id', '$nome','$senha')";
        if ($conn->query($sql) === TRUE) {
            $alunoID = $conn->insert_id;
    
            // Insira as matérias em que o aluno está matriculado na tabela "Aluno_Materia"
            foreach ($materias as $materiaID) {
                $sql = "INSERT INTO professor_Materia (professorID, MateriaID) VALUES ('$id', '$materiaID')";
                $conn->query($sql);
            }
    
            echo "professor cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o aluno: " . $conn->error;
        }
    }
    header("Location:../inicio_prof.php?ra=$ra2&s=s3");
}
?>
