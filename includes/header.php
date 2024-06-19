<?php
// Pastikan session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Pastikan SITE_NAME sudah didefinisikan di config.php
if (!defined('SITE_NAME')) {
    define('SITE_NAME', 'Komputer Store');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/custom.css">
    <!-- Tambahkan meta tags, favicon, atau link CSS tambahan di sini -->
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>/"><?php echo SITE_NAME; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>/index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo BASE_URL; ?>/produk/index.php">Produk</a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link" href="<?php echo BASE_URL; ?>/perbaikan/form.php?service=">Perbaikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../tentang-kami.php">Tentang Kami</a>
                        </li>
                        
                        <?php if (isset($_SESSION['IDuser'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/profil.php">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout.php">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/login.php">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
    <!-- Konten utama akan dimulai di sini -->