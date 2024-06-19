<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sippkbw/includes/functions.php';

$id = $_GET['id'];
$category = getCategory($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['namakategori'];

    if (updateCategory($id, $nama)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: Gagal memperbarui kategori";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Kategori</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input type="text" class="form-control" id="namakategori" name="namakategori" value="<?php echo $category['namakategori']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>