<?php

require 'controllers/Users.php';

$ctrl = new Users();
$page = $_SESSION['back'];

if (isset($_POST['formUser'])) {
    $user = new User();
    $user->id = $idUser;
    $user->name = $_POST['name'];
    $user->lastname = $_POST['lastname'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $result = $ctrl->saveUser($user);

    if ($result) {
        $last = $_SESSION['last'];
        if ($idUser == 0) {
            header('location:index.php?mod=users&page=' . $last . '&success=true');
        } else {
            header('location:index.php?mod=users&page=' . $page . '&success=true');
        }
        die();
    } else {
?>
        <div class="row justify-content-center container">
            <div class="col-lg-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Hubo un error al guardar los datos, intente de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php
    }
}

//$idUser se define en el index.php de users

if ($idUser == 0) {
    $user = new User();
    ?>
    <h2 class="text-center">Nuevo Usuario</h2>
<?php
} else {
?>
    <h2 class="text-center">Editar Usuario</h2>
<?php
    $user = $ctrl->getUser($idUser);
    if (!isset($user->id)) {
        header('location:index.php?mod=404');
        die();
    }
}
?>
<div class="row justify-content-center container">
    <div class="col-lg-6">
        <form method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input placeholder="Nombre" autofocus onfocus="this.setSelectionRange(this.value.length,this.value.length);" type="text" class="form-control" name="name" required value="<?php echo $user->name ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user-group"></i></span>
                <input placeholder="Apellido" type="text" class="form-control" name="lastname" required value="<?php echo $user->lastname ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input placeholder="Email" type="email" class="form-control" name="email" required value="<?php echo $user->email ?>">
            </div>
            <?php if ($idUser == 0) { ?>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input minlength="8" placeholder="Contraseña" type="password" class="form-control" name="password" required>
                </div>
            <?php } else { ?>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input minlength="8" placeholder="Contraseña" type="password" class="form-control" name="password">
                </div>
            <?php } ?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-danger me-md-2" href="index.php?mod=users&page=<?php echo $page ?>"><i class="fa-solid fa-xmark"></i> Cancelar</a>
                <button type="submit" name="formUser" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>