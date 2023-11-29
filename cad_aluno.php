<?php
//se conecta com o banco
require_once "bd/conexao.php";
//recebe o parametro ra
$ra = $_GET['ra'];

// Consulta SQL para obter o nome do aluno com base no RA
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
      <h1>Cadastro de Aluno</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio_aluno.php?ra=<?php echo $ra; ?>.html">Home</a></li>
          <li class="breadcrumb-item active">Cadastro de Aluno</li>
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
                <form action="bd/cadastro.php?type=aluno&ra=<?php echo $ra; ?>" method="POST" onsubmit="return validateForm()" class="mt-4">
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">RA</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="ra" name="ra" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Nome</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nome" name="nome" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Senha:</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Password" id="senha" name="senha" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Confirmar Senha:</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Password" id="confirmarSenha" name="confirmarSenha" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Matérias:</label>
                    <div class="col-sm-10">
                      <select class="form-select" multiple aria-label="multiple select example" id="materias" name="materias[]" required>
                        <?php
                                // Consulta SQL para buscar as matérias
                                $sql = "SELECT ID, NomeMateria FROM Materia";
                                $result = $conn->query($sql);

                                // Preencha as opções do select com as matérias
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['ID'] . "'>" . $row['NomeMateria'] . "</option>";
                                    }
                                }

                                // Feche a conexão com o banco de dados
                                $conn->close();
                        ?>
                      </select>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
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