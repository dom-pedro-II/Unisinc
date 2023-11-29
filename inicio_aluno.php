<?php
//se conecta com o banco
require_once "bd/conexao.php";
//recebe o parametro ra
$ra = $_GET['ra'];

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
<?php
    // Verifica se o parâmetro 's' está presente na URL
    if (isset($_GET['s'])) {
        $s = $_GET['s'];

        // Verifica o valor de 's' e chama a função JavaScript correspondente
        if ($s === 's1') {
            echo '<script>alert("RA2 não existe");</script>';
        } elseif ($s === 's2') {
          echo '<script>alert("Paciente não encontrado");</script>';
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
      <h1>UNISINC</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
  </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-8">
          <div class="card"> <!--Perguntas frequentes -->
            <div class="card-body">
              <h5 class="card-title">Perguntas Frequentes sobre Odontologia</h5>                 
                <div class="accordion" id="faqAccordion">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Como devo cuidar dos meus dentes diariamente?
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                      <div class="accordion-body">
                        Recomenda-se escovar os dentes pelo menos duas vezes ao dia, usar fio dental diariamente e limitar o consumo de alimentos açucarados.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Com que frequência devo visitar o dentista para check-ups?
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                      <div class="accordion-body">
                        Recomenda-se visitar o dentista pelo menos duas vezes por ano para check-ups regulares, mas a frequência pode variar dependendo das necessidades individuais.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Quais são os sinais de problemas dentários que devo observar?
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                      <div class="accordion-body">
                        Sinais comuns incluem dor persistente, gengivas sangrando e sensibilidade. Consulte seu dentista se notar esses sintomas.
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="card nutrition-dental-health overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Como a Nutrição Afeta a Saúde Bucal</h5>
              <p>A alimentação tem uma relação direta com a saúde dos dentes, motivo pelo qual alimentos ricos em fibras, cálcio, vitaminas C e D, por exemplo, ajudam a manter os dentes saudáveis, combatendo, inclusive, a ação de micro-organismos.</p>
              <p>No entanto, quando o paciente não segue uma dieta equilibrada e consome alimentos com grande quantidade de sódio, gordura e açúcar, ocorre a deficiência dos nutrientes que mantêm a saúde bucal, levando a problemas como o mau hálito, a cárie, a gengivite (inflamação na gengiva) e a periodontite (agravamento da gengivite).</p>
              <img src="assets/img/foto8.jpg" alt="Nutrição e Saúde Bucal" class="img-fluid">
            </div>
          </div>            
            <div class="card top-selling overflow-auto">
              <div class="card-body pb-0">
                <h5 class="card-title">Um pouco sobre nós <span>| UNISINC</span></h5>
              </div>
            </div>            
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> Como cuidar da saúde bucal? <span>| Dicas</span></h5>
              <div class="activity">
                <div class="activity-item d-flex">                  
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                     <a href="#" class="fw-bold text-dark">Escove bem os dentes antes de dormir</a> 
                  </div>
                </div>
                <div class="activity-item d-flex">
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Faça um bochecho antes da escovação
                  </div>
                </div>
                <div class="activity-item d-flex">                  
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Não esqueça de escovar a língua!
                  </div>
                </div>
                <div class="activity-item d-flex">                  
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Nada de deixar o fio dental de lado! 
                  </div>
                </div>
                <div class="activity-item d-flex">                  
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Cuide da gengiva
                  </div>
                </div>
                <div class="activity-item d-flex">                  
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Visite o dentista periodicamente
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="filter">    
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">O Poder da IA na Odontologia <span>| DOENÇAS GENGIVAIS</span></h5>
              <p>A pesquisa, conduzida em colaboração com várias instituições internacionais, destaca como a IA pode ser um instrumento valioso na identificação de problemas gengivais, como gengivite, a partir de fotografias intraorais. Isso não apenas simplifica o processo de diagnóstico, mas também abre novas possibilidades para intervenções mais precoces e personalizadas, potencialmente evitando complicações mais graves, como perda dentária, doenças cardiovasculares e diabetes.</p>
            </div>
          </div>
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Notícias &amp; Prevenções <span>| 2023</span></h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="assets/img/foto2.jpeg" alt="">
                  <h4><a href="#">A cárie é a segunda doença mais comum no mundo</a></h4>
                  <p>Por isso, é importante evitar alimentos que contenham muito açúcar, como doces e refrigerantes, além de manter a higiene sempre em dia, com o uso do fio dental e também com visitas regulares ao dentista.</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/foto3.jpeg" alt="">
                  <h4><a href="#">Os dentes são formados antes mesmo do nascimento</a></h4>
                  <p>Os bebês não nascem com dente, porém a formação dentária começa ainda na barriga da mãe. Essa fase recebe o nome de Odontogênese, momento em que é formada a coroa dentária.</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/foto4.jpg" alt="">
                  <h4><a href="#">O esmalte do dente é a parte mais dura do corpo</a></h4>
                  <p>Se você acha que o dente é a parte mais dura do corpo humano você está enganado. Na verdade é o esmalte dentário, formado por mais de 90% de minerais, como o zinco, magnésio e cobre.</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/foto5.jpeg" alt="">
                  <h4><a href="#">Mais de 300 espécies diferentes de bactérias são encontradas na boca</a></h4>
                  <p>Esses são números médios. Você pode ter mais, lembre-se de escovar, passar fio dental e usar bochechos para matá-los!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script src="assets/js/main.js"></script>

</body>

</html>