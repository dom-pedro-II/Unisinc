<?php
// Conecta com o banco
require_once "bd/conexao.php";

// Recebe o parâmetro ra
$ra = $_GET['ra'];
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'futuras';

// Consulta SQL para obter o nome do aluno com base no RA
$sqlAluno = "SELECT Nome FROM Aluno WHERE RA = $ra";
$resultAluno = $conn->query($sqlAluno);

if ($resultAluno->num_rows > 0) {
    $rowAluno = $resultAluno->fetch_assoc();
    $nomeAluno = $rowAluno['Nome'];
} else {
    $nomeAluno = "Aluno não encontrado";
}

// Construir a condição para filtrar consultas com base no valor de $filtro
if ($filtro === 'futuras') {
    $condicaoFiltro = "Consulta.DataConsulta >= CURDATE()";
} else {
    $condicaoFiltro = "Consulta.DataConsulta < CURDATE()";
}

// Consulta SQL para obter as consultas marcadas para o aluno com base no RA e na condição de filtro
$sqlConsultas = "SELECT Consulta.*, Paciente.Nome AS NomePaciente, Materia.NomeMateria AS NomeMateria
                FROM Consulta
                LEFT JOIN Paciente ON Consulta.PacienteID = Paciente.ID
                LEFT JOIN Materia ON Paciente.MateriaID = Materia.ID
                WHERE (Consulta.Aluno1RA = $ra OR Consulta.Aluno2RA = $ra)
                AND $condicaoFiltro";
$resultConsultas = $conn->query($sqlConsultas);
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
    
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

<body>
  <?php
    // Verifica se o parâmetro 's' está presente na URL
    if (isset($_GET['s'])) {
        $s = $_GET['s'];

        // Verifica o valor de 's' e chama a função JavaScript correspondente
        if ($s === 's1') {
            echo '<script>alert("Consulta atualizada com sucesso com sucesso");</script>';
        } elseif ($s === 's2') {
            echo '<script>alert("Consulta finalizada com sucesso com sucesso");</script>';
        } elseif ($s === 's3') {
          echo '<script>alert("Consulta desmarcada com sucesso com sucesso");</script>';
      }
    }
  ?>

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
      <h1>Consultas Marcadas para o aluno: <?php echo $nomeAluno; ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?ra=<?php echo $ra; ?>&filtro=futuras">Consultas Futuras</a></li>
          <li class="breadcrumb-item "><a href="?ra=<?php echo $ra; ?>&filtro=passadas">Consultas Antigas</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12"> 

          <div class="card">
            <div class="card-body">
            <table class="table datatable">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nome do Paciente</th>
                          <th scope="col">Clinica</th>
                          <th scope="col">Data</th>
                          <th scope="col">Hora Da Consulta</th>
                          <th scope="col">consulta Realizada</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      if ($resultConsultas->num_rows > 0) {
                          while ($rowConsulta = $resultConsultas->fetch_assoc()) {
                              $dataConsulta = $rowConsulta['DataConsulta'];
                              $horaConsulta = $rowConsulta['HoraConsulta'];
                              $pacienteNome = $rowConsulta['NomePaciente'];
                              $materiaNome = $rowConsulta['NomeMateria'];
                              $consultaID = $rowConsulta['ID'];
                              $atendido = $rowConsulta['realizada'];

                              echo "<tr>";
                              echo "<th>$consultaID</th>";
                              echo "<td>$pacienteNome</td>";
                              echo "<td>$materiaNome</td>";
                              echo "<td>$dataConsulta</td>";
                              echo "<td>$horaConsulta</td>";
                              echo "<td>$atendido</td>";
                              echo "<td><a class='edit-link' href='editar_consulta.php?consulta_id=$consultaID&ra=$ra'>Editar</a></td>";
                              echo "<td><a class='finish-link' href='finalizar_consulta.php?consulta_id=$consultaID&ra=$ra'>Encerrar Atendimento</a></td>";
                              echo "</tr>";
                          }
                      } else {
                          echo "<tr><td colspan='7'>Nenhuma consulta marcada para este aluno.</td></tr>";
                      }
                      ?>
                  </tbody>
              </table>
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