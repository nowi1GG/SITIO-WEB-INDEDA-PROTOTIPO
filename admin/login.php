<?php
include("./bd.php");
?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-4">
          
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
            <form action="" method="post">
            <div class="mb-3">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
            </div>
            <div class="mb-3">
              <label for="contrasenia" class="form-label">Contraseña</label>
              <input type="password"
                class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" placeholder="">
            </div>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Entrar</a>
            </form>  
            </div>
            <div class="card-footer text-muted">
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>