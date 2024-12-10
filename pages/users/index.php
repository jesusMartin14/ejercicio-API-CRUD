<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $_SESSION['back'] = $page;
    include 'home.php';
} else if (isset($_GET['edit'])) {
    $idUser = $_GET['edit'];
    include 'editNew.php';
} else if (isset($_GET['del'])) {
    $idUser = $_GET['del'];
    include 'delete.php';
} else {
    header('location: index.php?mod=404');
    die();
}
