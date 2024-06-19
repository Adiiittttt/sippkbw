<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
$idperbaikan=$_GET['id'];

mysqli_query($conn,
    "DELETE FROM perbaikan
    WHERE IDperbaikan='$idperbaikan'"
    );

    header("location:../perbaikan/index.php");
    ?>