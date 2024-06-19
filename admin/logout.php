<?php
session_start();
unset($_SESSION['sesi']);
unset($_SESSION['IDadmin']);
session_destroy();
header("Location:../index.php");
?>