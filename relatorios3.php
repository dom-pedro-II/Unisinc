<?php
require_once "bd/conexao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ra = $_GET['ra'];

    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        if ($tipo == "aluno") {
            // Lógica para consultar as consultas marcadas pelo aluno
            $sql = "SELECT Consulta.*, Paciente.Nome AS NomePaciente
                    FROM Consulta
                    INNER JOIN Paciente ON Consulta.PacienteID = Paciente.ID
                    WHERE Consulta.Aluno1RA = $id OR Consulta.Aluno2RA = $id";
            $result = $conn->query($sql);

            $consultas = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $consultas[] = $row;
                }
            }
        } elseif ($tipo == "tentativa") {
            // Lógica para consultar as tentativas de contato com o paciente
            $sql = "SELECT Motivo_Nao_Marcar.*, Aluno.Nome AS NomeAluno
                    FROM Motivo_Nao_Marcar
                    INNER JOIN Aluno ON Motivo_Nao_Marcar.RA_Aluno = Aluno.RA
                    WHERE Motivo_Nao_Marcar.PacienteID = $id";
            $result = $conn->query($sql);

            $tentativas = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tentativas[] = $row;
                }
            }
        } elseif ($tipo == "paciente") {
            // Lógica para consultar as consultas que o paciente passou
            $sql = "SELECT Consulta.*, Aluno1.Nome AS NomeAluno1, Aluno2.Nome AS NomeAluno2
                    FROM Consulta
                    INNER JOIN Aluno AS Aluno1 ON Consulta.Aluno1RA = Aluno1.RA
                    INNER JOIN Aluno AS Aluno2 ON Consulta.Aluno2RA = Aluno2.RA
                    WHERE Consulta.PacienteID = $id";
            $result = $conn->query($sql);

            $consultas_paciente = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $consultas_paciente[] = $row;
                }
            }
        } else {
            echo "erro";
        }
    } else {
        echo "erro tipo";
    }
} else {
    echo "erro id";
}

$sql = "SELECT Nome FROM professor WHERE ID = $ra";
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
      <a href="inicio_prof.php?ra=<?php echo $ra; ?>" class="logo d-flex align-items-center">
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
              <span>ADM CLINICAS DE Odonto</span>
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
        <a class="nav-link " href="cad_paciente.php?ra=<?php echo $ra; ?>">
          <i class="bi bi-file-person"></i>
          <span>Cadastrar Paciente</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" href="cad_aluno.php?ra=<?php echo $ra; ?>">
          <i class="bi bi-person-plus-fill"></i><span>Cadastrar Aluno</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" href="cad_professor.php?ra=<?php echo $ra; ?>">
          <i class="bi bi-person-plus-fill"></i><span>Cadastrar Professor/ADM</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" href="relatorios.php?ra=<?php echo $ra; ?>">
          <i class="bi bi-journal-bookmark"></i><span>Relatorios</span>
        </a>
      </li><!-- End Components Nav -->

      
      <li class="nav-heading">----------------------------</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="faq.php?ra=<?php echo $ra; ?>&tipo=professor">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="contato.php?ra=<?php echo $ra; ?>&tipo=professor">
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
      <h1>Relatorios</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio_prof.php?ra=<?php echo $ra; ?>">Home</a></li>
          <li class="breadcrumb-item active">Menu de Relatorios</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      
      <div class="col-lg-15">
        <div class="col-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Relatório</h5>
                <ul class="list-group">
                  <?php
                    if ($tipo == "aluno") :
                      foreach ($consultas as $consulta) :
                  ?>
                  <li class="list-group-item"><i class="bi bi-star me-1 text-danger"></i>
                    Consulta ID: <?php echo $consulta['ID']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                    Data: <?php echo $consulta['DataConsulta']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                    Hora: <?php echo $consulta['HoraConsulta']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                    Realizada: <?php echo $consulta['realizada']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                    Atendimento: <?php echo $consulta['atendimento']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                    Paciente: <?php echo $consulta['NomePaciente']; ?>
                  </li>
                  <?php
                      endforeach;
                    elseif ($tipo == "tentativa") :
                      foreach ($tentativas as $tentativa) :
                  ?>
                  <li class="list-group-item"><i class="bi bi-star me-1 text-danger"></i>
                      Motivo Não Marcar ID: <?php echo $tentativa['ID']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Motivo: <?php echo $tentativa['Motivo']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Data Registro: <?php echo $tentativa['DataRegistro']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Aluno: <?php echo $tentativa['NomeAluno']; ?>
                  </li>
                  <?php
                      endforeach;
                    elseif ($tipo == "paciente") :
                      foreach ($consultas_paciente as $consulta_paciente) :
                  ?>
                  <li class="list-group-item"><i class="bi bi-star me-1 text-danger"></i>
                      Consulta ID: <?php echo $consulta_paciente['ID']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Data: <?php echo $consulta_paciente['DataConsulta']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Hora: <?php echo $consulta_paciente['HoraConsulta']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Realizada: <?php echo $consulta_paciente['realizada']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Atendimento: <?php echo $consulta_paciente['atendimento']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Aluno1: <?php echo $consulta_paciente['NomeAluno1']; ?>,
                  </li>
                  <li class="list-group-item"><i class="bi bi-caret-right me-1 text-success"></i>
                      Aluno2: <?php echo $consulta_paciente['NomeAluno2']; ?>
                  </li>
                  <?php
                      endforeach;
                    endif;
                  ?>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>