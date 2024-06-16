<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

// Ambil ID layanan dari parameter URL
$service_id = isset($_GET['service']) ? clean_input($_GET['service']) : null;

// Ambil detail layanan jika ada ID layanan
$service = $service_id ? get_repair_service_by_id($service_id) : null;

// Proses form jika di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi dan proses data form
    $nama = clean_input($_POST['nama']);
    $email = clean_input($_POST['email']);
    $no_telp = clean_input($_POST['no_telp']);
    $jenis_perangkat = clean_input($_POST['jenis_perangkat']);
    $deskripsi_masalah = clean_input($_POST['deskripsi_masalah']);

    // Validasi data (tambahkan validasi sesuai kebutuhan)
    if (empty($nama) || empty($email) || empty($no_telp) || empty($jenis_perangkat) || empty($deskripsi_masalah)) {
        $error = "Semua field harus diisi.";
    } else {
        // Proses pengajuan perbaikan
        $result = add_repair_request([
            'nama_pelanggan' => $nama,
            'email' => $email,
            'no_telp' => $no_telp,
            'jenis_perangkat' => $jenis_perangkat,
            'deskripsi_masalah' => $deskripsi_masalah,
            'IDperbaikan' => $service_id
        ]);

        if ($result) {
            $success = "Pengajuan perbaikan berhasil dikirim. Kami akan menghubungi Anda segera.";
        } else {
            $error = "Terjadi kesalahan. Silakan coba lagi nanti.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Perbaikan - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<main class="container my-5">
    <h1 class="mb-4">Form Pengajuan Perbaikan</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php else: ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="no_telp" name="no_telp" required>
            </div>
            <div class="mb-3">
                <label for="jenis_perangkat" class="form-label">Jenis Perangkat</label>
                <input type="text" class="form-control" id="jenis_perangkat" name="jenis_perangkat" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_masalah" class="form-label">Deskripsi Masalah</label>
                <textarea class="form-control" id="deskripsi_masalah" name="deskripsi_masalah" rows="3" required></textarea>
            </div>
            <?php if ($service): ?>
                <input type="hidden" name="IDperbaikan" value="<?php echo $service['IDperbaikan']; ?>">
                <p><strong>Layanan yang dipilih:</strong> <?php echo htmlspecialchars($service['nama']); ?></p>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
        </form>
    <?php endif; ?>
</main>

<?php include '../includes/footer.php'; ?>

<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>