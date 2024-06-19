<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

// Jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $jenis_perangkat = $_POST['jenis_perangkat'];
    $deskripsi_masalah = $_POST['deskripsi_masalah'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $status = $_POST['status'];
    $biaya = $_POST['biaya'];
    $catatan = $_POST['catatan'];

    $sql = "UPDATE perbaikan SET
            nama_pelanggan = '$nama_pelanggan',
            no_telp = '$no_telp',
            email = '$email',
            jenis_perangkat = '$jenis_perangkat',
            deskripsi_masalah = '$deskripsi_masalah',
            tanggal_masuk = '$tanggal_masuk',
            tanggal_selesai = '$tanggal_selesai',
            status = '$status',
            biaya = '$biaya',
            catatan = '$catatan'
            WHERE IDperbaikan = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data perbaikan berhasil diperbarui.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Jika ID perbaikan diberikan melalui query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $perbaikan = get_repair_service_by_id($id);

    if ($perbaikan) {
        $row = $perbaikan;
    } else {
        echo "Data perbaikan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID perbaikan tidak diberikan.";
    header("Location: index.php");
    exit;
}
?>

<!-- Kode HTML formulir edit -->

<!DOCTYPE html>
<html>
<head>
    <title>Edit Perbaikan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Perbaikan</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $row['IDperbaikan']; ?>">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan:</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $row['nama_pelanggan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telp"> No. Telepon:</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $row['no_telp']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="jenis_perangkat">Jenis Perangkat:</label>
                <input type="text" class="form-control" id="jenis_perangkat" name="jenis_perangkat" value="<?php echo $row['jenis_perangkat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_masalah">Deskripsi Masalah:</label>
                <textarea class="form-control" id="deskripsi_masalah" name="deskripsi_masalah" required><?php echo $row['deskripsi_masalah']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $row['tanggal_masuk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?php echo $row['tanggal_selesai']; ?>">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Menunggu" <?php if ($row['status'] == 'Menunggu') echo 'selected'; ?>>Menunggu</option>
                    <option value="Dalam Proses" <?php if ($row['status'] == 'Dalam Proses') echo 'selected'; ?>>Dalam Proses</option>
                    <option value="Selesai" <?php if ($row['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                    <option value="Dibatalkan" <?php if ($row['status'] == 'Dibatalkan') echo 'selected'; ?>>Dibatalkan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="biaya">Biaya:</label>
                <input type="number" class="form-control" id="biaya" name="biaya" value="<?php echo $row['biaya']; ?>" step="0.01">
            </div>
            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea class="form-control" id="catatan" name="catatan"><?php echo $row['catatan']; ?></textarea>
            </div>
            <button type="submit" href="../index.php" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>