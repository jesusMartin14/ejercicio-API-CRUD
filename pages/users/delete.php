<?php

require 'controllers/Users.php';

$ctrl = new Users();
$page = $_SESSION['back'];

if (isset($_POST['eliminarUser'])) {
    $result = $ctrl->deleteUser($idUser);
    if ($result) {
        header('location:index.php?mod=users&page=' . $page.'&success=true');
        die();
    } else { ?>
        <div class="row justify-content-center container">
            <div class="col-lg-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Hubo un error al eliminar los datos, intente de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
<?php
    }
}

//$idUser se define en el index.php

$user = $ctrl->getUser($idUser);
if (!isset($user->id)) {
    header('location:index.php?mod=404');
    die();
}

?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="alert alert-warning" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> ¿Desea eliminar el usuario <?php echo $user->name ?>?
            <form method="POST">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a class="btn btn-primary me-md-2" href="index.php?mod=users&page=<?php echo $page ?>"><i class="fa-solid fa-xmark"></i> Cancelar</a>
                    <button type="submit" name="eliminarUser" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>