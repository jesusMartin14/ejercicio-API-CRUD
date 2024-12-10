<?php
require 'controllers/Users.php';

$ctrl = new Users();
$search = isset($_GET['q']) ? $_GET['q'] : '';
$rows = $ctrl->getRows($search) /   10;
if ($rows == 0) {
?>
    <div class="row mb-5">
        <div class="col-4">
            <a href="index.php?mod=users&edit=0" class="btn btn-sm btn-success px-4"><i class="fa-solid fa-user-plus"></i> Nuevo</a>
        </div>
        <div class="col-6 col-lg-3 ms-auto">
            <form method="GET">
                <input type="text" class="d-none" name="mod" value="users">
                <input type="text" class="d-none" name="page" value="1">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input name="q" type="search" class="form-control" placeholder="Buscar..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : '' ?>">
                </div>
                <button type="submit" class="d-none"></button>
            </form>
        </div>
    </div>
    <h5 class="text-danger">No se encontraron resultados.</h5>
<?php
    die();
}
$pagesNumber = (int)$rows + 1;
$_SESSION['last'] = $pagesNumber;

//$page se definió en el index.php

if ($page == 0 || $page > $pagesNumber || !is_numeric($page)) {
    header('location: index.php?mod=404');
    die();
}
$users = $ctrl->getUsers($page, $search);
$pages = array();
for ($i = 1; $i <= $pagesNumber; $i++) {
    $pages[] = $i;
}

if (isset($_GET['success']) && $_GET['success'] == 'true') {
?>
    <div class="row justify-content-center container">
        <div class="col-lg-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-regular fa-circle-check"></i> Datos actualizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php
}
?>
<div class="row mb-3">
    <div class="col-4">
        <a href="index.php?mod=users&edit=0" class="btn btn-sm btn-success px-4"><i class="fa-solid fa-user-plus"></i> Nuevo</a>
    </div>
    <div class="col-6 col-lg-3 ms-auto">
        <form method="GET">
            <input type="text" class="d-none" name="mod" value="users">
            <input type="text" class="d-none" name="page" value="1">
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input name="q" type="search" class="form-control" placeholder="Buscar..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : '' ?>">
            </div>
            <button type="submit" class="d-none"></button>
        </form>
    </div>
</div>
<table class="table table-sm table-striped" id="tablaUsers">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($users); $i++) {
        ?>
            <tr>
                <th scope="row"><?php echo $users[$i]->id ?></th>
                <td><?php echo $users[$i]->name ?></td>
                <td><?php echo $users[$i]->lastname ?></td>
                <td><?php echo $users[$i]->email ?></td>
                <td>
                    <a href="index.php?mod=users&edit=<?php echo $users[$i]->id; ?>" class="btn btn-sm btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="index.php?mod=users&del=<?php echo $users[$i]->id; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<nav aria-label="..." class="d-flex justify-content-end">
    <ul class="pagination">
        <li class="page-item <?php echo $page == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="<?php echo $page != 0 ? "index.php?mod=users&page=" . $page - 1 : ""; ?><?php echo $search != '' ? '&q=' . $search : '' ?>"><i class="fa-solid fa-backward-step"></i></a>
        </li>
        <?php
        $inicio = 1;
        if ($pagesNumber > 5) {
            $count = 0;
            if ($page >= 3 && $page < ($pagesNumber - 1)) {
                $inicio = $page - 2;
            } else if ($page < 3) {
                $inicio = 1;
            } else {
                $inicio = $pagesNumber - 4;
            }
            while ($inicio <= $pagesNumber) {
                $count++;
        ?>
                <li class="page-item <?php echo $page == $inicio || ($page == 0 && $inicio == 1) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?mod=users&page=<?php echo $inicio ?><?php echo $search != '' ? '&q=' . $search : '' ?>"><?php echo $inicio ?></a>
                </li>
            <?php if ($count == 5) break;
                $inicio++;
            }
        } else {
            while ($inicio <= $pagesNumber) { ?>
                <li class="page-item <?php echo $page == $inicio || ($page == 0 && $inicio == 1) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?mod=users&page=<?php echo $inicio ?><?php echo $search != '' ? '&q=' . $search : '' ?>"><?php echo $inicio ?></a>
                </li>
        <?php $inicio++;
            }
        }
        ?>
        <li class="page-item <?php echo $page == $pagesNumber ? 'disabled' : '' ?>">
            <a class=" page-link" href="<?php echo $page != 0 ? "index.php?mod=users&page=" . $page + 1 : ""; ?><?php echo $search != '' ? '&q=' . $search : '' ?>"><i class="fa-solid fa-forward-step"></i></a>
        </li>
    </ul>
</nav>