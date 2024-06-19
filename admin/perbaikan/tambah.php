<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $jenis_perangkat = $_POST['jenis_perangkat'];
    $deskripsi_masalah = $_POST['deskripsi_masalah'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    if (getRepairServices($nama_pelanggan, $no_telp, $email, $jenis_perangkat, $deskripsi_masalah, $tanggal_masuk)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: Gagal menambahkan data perbaikan";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Perbaikan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Perbaikan</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="jenis_perangkat">Jenis Perangkat</label>
                <input type="text" class="form-control" id="jenis_perangkat" name="jenis_perangkat" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_masalah">Deskripsi Masalah</label>
                <textarea class="form-control" id="deskripsi_masalah" name="deskripsi_masalah" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>