<?php $url_base="http://localhost/project/admin/"; ?>

<!doctype html>
<html lang="en">

<head>
  <title>Administrador Sitio Web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">

</head>

<body>
  <header>
    <!-- place navbar here -->

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios/">Servicios</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/deportes/">Deportes</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/sobre_nosotros/">Sobre Nosotros</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/personal/">Personal</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/usuarios/">Usuarios</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>login.php">Cerrar sesion</a>
        </div>
    </nav>
  </header>
  <main class="container">
    <br/>