<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
$idproduk=$_GET['id'];

mysqli_query($conn,
    "DELETE FROM produk
    WHERE IDproduk='$idproduk'"
    );

    header("location:../produk/index.php");
    ?>