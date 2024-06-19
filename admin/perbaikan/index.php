<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

$perbaikan = getRepairServices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Perbaikan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Daftar Perbaikan</h2>
        <a href="tambah.php" class="btn btn-primary mb-3">Tambah Perbaikan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Jenis Perangkat</th>
                    <th>Deskripsi Masalah</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Biaya</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perbaikan as $data): ?>
                    <tr>
                        <td><?php echo $data['IDperbaikan']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo isset($data['no_telp']) ? $data['no_telp'] : '-'; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['jenis_perangkat']; ?></td>
                        <td><?php echo $data['deskripsi_masalah']; ?></td>
                        <td><?php echo $data['tanggal_masuk']; ?></td>
                        <td><?php echo $data['tanggal_selesai']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td><?php echo $data['biaya']; ?></td>
                        <td><?php echo $data['catatan']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $data['IDperbaikan']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="hapus.php?id=<?php echo $data['IDperbaikan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data perbaikan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>