<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Tampilkan alert sebelum redirect
echo '<script>
        alert("Anda telah logout.");
        window.location.href = "../index.php";
      </script>';
exit;
?>