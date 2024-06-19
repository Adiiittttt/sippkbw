<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';
// Ambil ID produk dari parameter URL
$product_id = isset($_GET['id']) ? clean_input($_GET['id']) : null;

// Jika tidak ada ID produk, redirect ke halaman daftar produk
if (!$product_id) {
    header('Location: /produk/');
    exit();
}

// Ambil detail produk
$product = get_product_by_id($product_id);

// Jika produk tidak ditemukan, tampilkan pesan error
if (!$product) {
    $error = "Produk tidak ditemukan.";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product ? htmlspecialchars($product['nama']) : 'Produk Tidak Ditemukan'; ?> - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<main class="container my-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php elseif ($product): ?>
        <div class="row">
            <div class="col-md-6">
            <img src="<?php echo BASE_URL . '../assets/images/' . $product['gambar']; ?>" class="img-fluid" alt="<?php echo $produk['nama']; ?>">
            </div>
            <div class="col-md-6">
                <h1 class="mb-4"><?php echo htmlspecialchars($product['nama']); ?></h1>
                <p class="lead"><?php echo htmlspecialchars($product['deskripsi']); ?></p>
                <p><strong>Harga:</strong> Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                <p><strong>Stok:</strong> <?php echo $product['stok']; ?> unit</p>
                <a href="" class="btn btn-primary btn-lg">Beli Sekarang</a>
                <a href="../produk/" class="btn btn-secondary btn-lg">Kembali ke Daftar Produk</a>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include '../includes/footer.php'; ?>

<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>