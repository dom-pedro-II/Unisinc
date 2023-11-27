<?php
// Se conecta com o banco de dados
require_once "bd/conexao.php";

// Recebe o parâmetro ra e materia_id
$ra = $_GET['ra'];
$materia_id = $_GET['materia_id'];

// Consulta SQL para obter o nome do aluno com base no RA
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
      <h1>Seleção de paciente</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio_aluno.php?ra=<?php echo $ra; ?>.html">Home</a></li>
          <li class="breadcrumb-item active">Seleção de paciente</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      
      <div class="col-lg-12">
        <div class="col-8">
          <div class="card">
            <div class="card-body">
              <?php
                  // Consulta para obter o próximo paciente da fila com base na matéria selecionada
                  $consulta = "SELECT p.ID, p.Nome, p.email, p.tel, p.tel2 FROM Fila AS f
                              JOIN Paciente AS p ON f.PacienteID = p.ID
                              WHERE p.MateriaID = $materia_id
                              ORDER BY f.ID ASC LIMIT 1";
                  $resultado = mysqli_query($conn, $consulta);

                  // Exibe o resultado da consulta 
                  if (mysqli_num_rows($resultado) > 0) {
                    $paciente = mysqli_fetch_assoc($resultado);
              ?>
                <h5 class="card-title">Paciente:</h5>
                  <p><strong>Nome:</strong> <?php echo $paciente['Nome']; ?></p>
                  <p><strong>Email:</strong> <?php echo $paciente['email']; ?></p>
                  <p><strong>Telefone:</strong> <?php echo $paciente['tel']; ?></p>
                  <p><strong>Telefone:</strong> <?php echo $paciente['tel2']; ?></p>

                <form method="post" action="marcar_consulta.php">
                  <input type="hidden" name="paciente_id" value="<?php echo $paciente['ID']; ?>">
                  <input type="hidden" name="ra" value="<?php echo $ra; ?>">
                  <div class="form-group">
                    <label for="ra2">RA do Segundo Aluno:</label>
                    <input type="text" name="ra2" id="ra2" class="form-control">
                  </div>
                  <div class="row mb-3">
                    <div class="form-group">
                      <label for="data">Data da Consulta:</label>
                      <input type="date" name="data" id="data" class="form-control">
                    </div>
                  </div>
                  <div class="card-body">
                    <button type="submit" name="marcar_consulta" class="btn btn-success btn-marcar">Marcar Consulta</button>
                    <a href="motivo_nao_marcar.php?ra=<?php echo $ra; ?>&paciente_id=<?php echo $paciente['ID']; ?>" class="btn btn-danger btn-nao-retornou">Não Retornou Contato</a>
                    <a id="voltar" class="btn btn-primary" data-bs-dismiss="modal" href="inicio_aluno.php?ra=<?php echo $ra; ?>">Voltar</a>
                  </div>
                </form>
                <?php
                  } else {
                    echo "<p>Nenhum paciente na fila nesta matéria.</p>";
                  }
                ?>  
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>