<?php
require_once "bd/conexao.php";
// Verificar se o ID do paciente foi passado na URL
if (isset($_POST['paciente_id'])) {
    $pacienteID = $_POST['paciente_id'];
    $ra = $_POST['ra'];
    $ra2 = $_POST['ra2'];
    $DataConsulta = $_POST['data'];
    $aluno2RA = $ra2;
    $aluno1RA = $ra;
    
    // Consulta para obter o nome do paciente com base no ID
    $consultaPaciente = "SELECT Nome FROM Paciente WHERE ID = $pacienteID";
    $resultadoPaciente = mysqli_query($conn, $consultaPaciente);

    if (mysqli_num_rows($resultadoPaciente) > 0) {
        $dadosPaciente = mysqli_fetch_assoc($resultadoPaciente);
        $nomePaciente = $dadosPaciente['Nome'];
    } else {
        $nomePaciente = "Paciente não encontrado";
    }
    $sql = "SELECT Nome FROM Aluno WHERE RA = $ra";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomeAluno = $row['Nome'];
    } else {
        $nomeAluno = "Aluno não encontrado";
    }
} else {
    // Se o ID do paciente não foi passado, redirecione de volta para a página anterior ou faça alguma outra ação
    header("Location: inicio_aluno.php");
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
        <a class="nav-link collapsed" href="faq.php?ra=<?php echo $ra; ?>">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
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
      <h1>Marcar consulta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio_aluno.php?ra=<?php echo $ra; ?>.html">Home</a></li>
          <li class="breadcrumb-item active">Marcar Consulta</li>
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
                  
                  <h5 class="card-title">Marcar Consulta para <?php echo $nomePaciente; ?></h5>
                  <form method="post" action="bd/processar_consulta.php?ra1=<?php echo $aluno1RA ?>&ra2=<?php echo $aluno2RA ?>&data=<?php echo $DataConsulta?>">
                      <div class="form-group">
                          <label for="horaConsulta">Escolha um horário disponível</label>
                          <select class="form-control" id="horaConsulta" name="horaConsulta" required>
                          <?php
                              $horariosDisponiveis = array();
                              $horarioAtual = strtotime('09:00:00');
                              $horarioFim = strtotime('19:00:00');
                              $intervalo = 60 * 60; // 1 hora em segundos

                              while ($horarioAtual < $horarioFim) {
                                  $horarioFormatado = date('H:i', $horarioAtual);

                                  // Verificar se o horário já foi agendado para algum dos alunos
                                  $consultaHorario = "SELECT * FROM Consulta WHERE DataConsulta = '$DataConsulta' AND HoraConsulta = '$horarioFormatado' AND (Aluno1RA = '$aluno1RA' OR Aluno2RA = '$aluno2RA')";
                                  $resultadoHorario = mysqli_query($conn, $consultaHorario);

                                  if (mysqli_num_rows($resultadoHorario) == 0) {
                                      $horariosDisponiveis[] = $horarioFormatado;
                                  }

                                  $horarioAtual += $intervalo;
                              }
                              foreach ($horariosDisponiveis as $horario) {
                                  echo "<option value='$horario'>$horario</option>";
                              }
                          ?>
                          </select>
                      </div>
                      <input type="hidden" name="pacienteID" value="<?php echo $pacienteID; ?>">
                      <button type="submit" class="btn btn-primary">Marcar Consulta</button>
                  </form>
                </div>
              </div>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>