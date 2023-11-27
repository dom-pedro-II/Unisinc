<?php

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aluno</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="bd/login.php?tipo=<?php echo $tipo; ?>">
                    <div class="logo text-center mb-4">
                        <img src="foto1.jpeg" alt="Logo" />
                    </div>
                    <h2 class="text-center text-primary mb-4">Tela de Login</h2>
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <a href="https://api.whatsapp.com/send?phone=5515997588762&amp;text=Ol%C3%A1%2C+preciso+de+ajuda+na+loja+virtual%21" title="Clique aqui para entrar em contato conosco via Whatsapp" target="_blank" class="btn btn-primary"></a>
            </div>
        </div>
    </div>
</body>

</html>
