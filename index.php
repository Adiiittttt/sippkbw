<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Penjualan & Perbaikan Komputer</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/custom.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand">Computer Store & repair Solution</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produk/index.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/perbaikan/form.php?service=<?php ['IDperbaikan']; ?>">Perbaikan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/tentang-kami.php"> Tentang Kami </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/admin/login.php"> Login </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Selamat Datang di Computer Store & repair Solution</h1>
            <p class="lead">Kami menyediakan layanan penjualan dan perbaikan komputer terbaik untuk Anda.</p>
            
            <h2 class="mt-5 mb-3">Produk Unggulan</h2>
            <div class="row">
                <?php
                // Ambil 3 produk unggulan dari database
                $featured_products = get_featured_products(3);
                foreach ($featured_products as $product) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $product['gambar']; ?>" class="card-img-top" alt="<?php echo $product['nama']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['nama']; ?></h5>
                                <p class="card-text"><?php echo substr($product['deskripsi'], 0, 100) . '...'; ?></p>
                                <a href="<?php echo BASE_URL; ?>/produk/detail.php?id=<?php echo $product['IDproduk']; ?>" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="mb-4">Layanan Perbaikan</h3>
            <ul class="list-group">
                <li class="list-group-item">Perbaikan Laptop</li>
                <li class="list-group-item">Perbaikan PC Desktop</li>
                <li class="list-group-item">Upgrade Hardware</li>
                <li class="list-group-item">Instalasi Software</li>
            </ul>
            
            <a href="<?php echo BASE_URL; ?>/perbaikan/form.php?service=<?php ['IDperbaikan']; ?>" class="btn btn-primary mt-1">Ajukan Perbaikan</a>
        </div>
    </div>
</main>

<footer class="bg-light py-4 mt-5">
    <div class="container text-center">
        <p>&copy; 2024 Computer Store & repair Solution. Hak Cipta Dilindungi.</p>
    </div>
</footer>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/custom.js"></script>
</body>
</html>