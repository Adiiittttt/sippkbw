<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

// Ambil semua kategori
$categories = get_all_categories();

// Ambil kategori yang dipilih (jika ada)
$selected_category = isset($_GET['category']) ? clean_input($_GET['category']) : null;

// Ambil produk berdasarkan kategori atau semua produk jika tidak ada kategori yang dipilih
$products = $selected_category ? get_products_by_category($selected_category) : get_all_products();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<main class="container my-5">
    <h1 class="mb-4">Daftar Produk</h1>

    <div class="row">
        <div class="col-md-3">
            <h3>Kategori</h3>
            <ul class="list-group">
                <li class="list-group-item<?php echo !$selected_category ? ' active' : ''; ?>">
                    <a href="/produk/" class="text-decoration-none<?php echo !$selected_category ? ' text-white' : ''; ?>">Semua Produk</a>
                </li>
                <?php foreach ($categories as $category): ?>
                    <li class="list-group-item<?php echo $selected_category == $category['IDkategori'] ? ' active' : ''; ?>">
                        <a href="/produk/?category=<?php echo $category['IDkategori']; ?>" class="text-decoration-none<?php echo $selected_category == $category['IDkategori'] ? ' text-white' : ''; ?>">
                            <?php echo htmlspecialchars($category['nama']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($product['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['nama']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['nama']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($product['deskripsi'], 0, 100)) . '...'; ?></p>
                                <p class="card-text"><strong>Harga: Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></strong></p>
                                <a href="<?php echo BASE_URL; ?>/produk/detail.php?id=<?php echo $product['IDproduk']; ?>" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>