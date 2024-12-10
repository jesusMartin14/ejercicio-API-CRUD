<?php session_start() ?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tienda</title>

  <!-- CSS -->

  <!-- FONTAWESOME CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />


  <!-- SCRIPTS -->

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- BOOTSTRAP CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?mod=users&page=1"><i class="fa-solid fa-tablet-screen-button"></i> Ejercicio práctico</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php echo isset($_GET['mod']) && $_GET['mod'] == 'users' ? 'active' : '' ?>" href="index.php?mod=users&page=1"><i class="fa-solid fa-users"></i> Usuarios</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li><a class="dropdown-item text-danger" href="login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Salir</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php
    if (isset($_GET['logged']) && $_GET['logged'] == 'true') { ?>
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Bienvenido, ha iniciado sesión satisfactoriamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php }
    if (!isset($_SESSION['logged'])){
      header('location: login.php');
      die();
    }else if(isset($_GET['mod']) && file_exists('pages/' . $_GET['mod'] . '/index.php')) {
      include 'pages/' . $_GET['mod'] . '/index.php';
    } else {
      header('location: index.php?mod=404');
      die();
    }
    ?>
  </div>

</body>

</html>