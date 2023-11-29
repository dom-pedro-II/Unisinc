<?php
// Se conecta com o banco de dados
require_once "bd/conexao.php";

// Recebe os parâmetros ra e paciente_id da URL
$ra = $_GET['ra'];
$paciente_id = $_GET['paciente_id'];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o motivo do não agendamento da consulta do formulário
    $motivo = $_POST['motivo'];

    // Atualiza a tabela Motivo_Nao_Marcar
    $sql_motivo = "INSERT INTO Motivo_Nao_Marcar (PacienteID, Motivo, RA_Aluno) VALUES ($paciente_id, '$motivo', $ra)";
    if ($conn->query($sql_motivo) === TRUE) {
        // Atualiza a tabela Fila para realocar o paciente no último lugar
        $sql_fila = "UPDATE Fila SET ID = (SELECT MAX(ID) + 1 FROM Fila) WHERE PacienteID = $paciente_id";
        if ($conn->query($sql_fila) === TRUE) {
            echo "Motivo registrado com sucesso e paciente realocado no final da fila.";
            header("Location: inicio_aluno.php?ra=" . $ra);
        } else {
            echo "Erro ao realocar o paciente na fila: " . $conn->error;
        }
    } else {
        echo "Erro ao registrar o motivo: " . $conn->error;
    }
}// Consulta SQL para obter o nome do aluno com base no RA
$sql = "SELECT Nome FROM Aluno WHERE RA = $ra";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nomeAluno = $row['Nome'];
} else {
    $nomeAluno = "Aluno não encontrado";
}

?>

<!DOCTYPE html>
<html lang="PT">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UNISINC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
  <script src="js/index.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="inicio_aluno.php?ra=<?php echo $ra; ?>" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">UNISINC</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nomeAluno; ?></span>
          </a><!-- End Profile  -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $nomeAluno; ?></h6>
              <span>Aluno Odonto</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>SAIR</span>
              </a>
            </li>
          </ul>
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="agenda.php?ra=<?php echo $ra; ?>&filtro=futuras">
          <i class="bi bi-calendar-event"></i>
          <span>Agendas</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" href="prox_paciente.php?ra=<?php echo $ra; ?>">
          <i class="bi bi-person-check-fill"></i><span>Proximo Paciente</span>
        </a>
      </li><!-- End Components Nav -->

      
      <li class="nav-heading">----------------------------</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="faq.php?ra=<?php echo $ra; ?>&tipo=aluno">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="contato.php?ra=<?php echo $ra; ?>&tipo=aluno">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->  

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Motivo para Não Marcar Consulta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio_aluno.php?ra=<?php echo $ra; ?>.html">Home</a></li>
          <li class="breadcrumb-item active">Motivo para Não Marcar Consulta</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <form method="post" action="">
                    <input type="hidden" name="ra" value="<?php echo $ra; ?>">
                    <input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
                    <div class="form-group">
                        <label for="motivo">Informe o motivo pelo qual você não marcou a consulta:</label>
                        <textarea class="form-control" name="motivo" id="motivo" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="registrar_motivo" class="btn btn-success">Registrar Motivo</button>
                    <a id="voltar" class="btn btn-lg btn-primary" href="inicio_aluno.php?ra=<?php echo $ra; ?>">Voltar</a>
                </form>
                </div>
              </div>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>