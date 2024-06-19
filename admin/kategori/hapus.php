<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
$idkategori=$_GET['id'];

mysqli_query($conn,
    "DELETE FROM kategori
    WHERE IDkategori='$idkategori'"
    );

    header("location:../kategori/index.php");
    ?>