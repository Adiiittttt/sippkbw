<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

$categories = getAllCategories();

$id = $_GET['id'];
$product = get_Product_By_Id($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar'];
    $kategori = $_POST['kategori'];

    // Validasi dan penyimpanan gambar
    $folder_gambar = "../assets/images/produk/";
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $ekstensi_gambar = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));

    if (!empty($gambar['name'])) {
        if (!in_array($ekstensi_gambar, $ekstensi_diperbolehkan)) {
            echo "Ekstensi gambar tidak diperbolehkan!";
            exit;
        }

        $nama_gambar = uniq_id() . "." . $ekstensi_gambar;
        $path_gambar = $folder_gambar . $nama_gambar;

        if (move_uploaded_file($gambar['tmp_name'], $path_gambar)) {
            // Hapus gambar lama jika ada
            if (!empty($product['gambar'])) {
                unlink($product['gambar']);
            }
        } else {
            echo "Error: Gagal mengupload gambar";
        }
    } else {
        $path_gambar = $product['gambar'];
    }

    if (updateProduct($id, $nama, $deskripsi, $harga, $stok, $path_gambar, $kategori)) {
        header('Location: ../produk/index.php');
        exit;
    } else {
        echo "Error: Gagal memperbarui produk";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Produk</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $product['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $product['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $product['harga']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form -control" id="stok" name="stok" value="<?php echo $product['stok']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar">
                <?php if (!empty($product['gambar'])): ?>
                    <br>
                    <img src="<?php echo $product['gambar']; ?>" alt="Gambar Produk" class="img-thumbnail" style="max-width: 200px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['IDkategori']; ?>" <?php if ($category['IDkategori'] == $product['IDkategori']) echo 'selected'; ?>><?php echo $category['namakategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>