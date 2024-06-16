<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

// Ambil daftar layanan perbaikan
$repair_services = get_repair_services();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Perbaikan - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<main class="container my-5">
    <h1 class="mb-4">Layanan Perbaikan</h1>

    <div class="row">
        <?php foreach ($repair_services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($service['nama']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($service['deskripsi']); ?></p>
                        <p class="card-text"><strong>Estimasi Biaya:</strong> Rp <?php echo number_format($service['estimasi_biaya'], 0, ',', '.'); ?></p>
                        <a href="<?php echo BASE_URL; ?>/perbaikan/form.php?service=<?php echo $service['IDperbaikan']; ?>" class="btn btn-primary">Ajukan Perbaikan</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>