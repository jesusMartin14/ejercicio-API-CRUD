<?php
session_start();
session_destroy();

require 'controllers/Login.php';

$ctrl = new Login();
$error = false;

if (isset($_POST['formLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = [
        'email' => $email,
        'password' => $password
    ];

    $result = $ctrl->login($data);

    if ($result) {
        session_start();
        $_SESSION['logged'] = true;
        header('location:index.php?mod=users&page=1&logged=true');
        die();
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ejercicio</title>

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
            <a class="navbar-brand" href="login.php"><i class="fa-solid fa-tablet-screen-button"></i> Ejercicio práctico</a>
        </div>
    </nav>
    <div class="container">
        <?php
        if ($error) { ?>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Email o contraseña incorrectos, intente de nuevo.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php }
        ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h2>Iniciar sesión</h2>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input placeholder="Email" autofocus type="email" class="form-control" name="email" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input placeholder="Contraseña" minlength="8" type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" name="formLogin" class="btn btn-primary d-block ms-auto"><i class="fa-solid fa-arrow-right-to-bracket"></i> Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>