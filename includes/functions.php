<?php

// Pastikan file ini hanya dijalankan dalam konteks yang benar
if (!defined('DB_HOST')) {
    exit('Akses langsung ke file ini tidak diizinkan.');
}
// Fungsi untuk login admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Username atau password salah";
    }
}

// Fungsi untuk logout admin
if (isset($_GET['logout'])) {
    unset($_SESSION['admin']);
    session_destroy();
    header('Location: index.php');
    exit;
}

function get_featured_products($limit) {
    global $conn;
    $sql = "SELECT * FROM produk ORDER BY RAND() LIMIT $limit";
    $result = $conn->query($sql);
    $products = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = array(
                'IDproduk' => $row['IDproduk'],
                'nama' => $row['nama'],
                'deskripsi' => $row['deskripsi'],
                'harga' => $row['harga'],
                'gambar' => BASE_URL . '/assets/images/' . $row['gambar']
            );
        }
    }
    
    return $products;
}


function getRepairServices() {
    global $conn;
    $services = array();

    $query = "SELECT 
        IDperbaikan, 
        jenis_perangkat, 
        nama_pelanggan, 
        no_telp, 
        email,
        deskripsi_masalah, 
        tanggal_masuk, 
        tanggal_selesai, 
        biaya, 
        status, 
        catatan
    FROM perbaikan 
    ORDER BY tanggal_masuk DESC";

    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $services[] = $row;
        }
        mysqli_free_result($result);
    } else {
        error_log("Database query failed: " . mysqli_error($conn));
    }

    return $services;
}
function addProduct($nama, $deskripsi, $harga, $kategori, $stok, $gambar) {
    global $conn;
    $sql = "INSERT INTO produk (nama, deskripsi, harga, IDkategori, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiis", $nama, $deskripsi, $harga, $kategori, $stok, $gambar);
    return $stmt->execute();
}

function getAllProducts() {
    global $conn; // Asumsikan $conn adalah variabel koneksi database yang sudah didefinisikan di config.php
    
    $products = array();
    
    $query = "SELECT * FROM produk ORDER BY IDproduk DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        mysqli_free_result($result);
    }
    
    return $products;
}
function formatRupiah($angka) {
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
/**
 * Fungsi untuk mengambil semua kategori
 * 
 * @return array Array dari kategori
 */
function getallcategories() {
    global $conn;
    $categories = [];

    $sql = "SELECT * FROM kategori ORDER BY namakategori ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }

    return $categories;
}

/**
 * Fungsi untuk mengambil produk berdasarkan kategori
 * 
 * @param int $IDkategori ID kategori
 * @param int $limit Jumlah produk yang akan diambil
 * @return array Array dari produk
 */
function get_products_by_category($IDkategori, $limit = 10) {
    global $conn;
    $products = [];

    if ($IDkategori == 0) {
        $sql = "SELECT * FROM produk LIMIT ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $limit);
    } else {
        $sql = "SELECT * FROM produk WHERE IDkategori = ? LIMIT ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $IDkategori, $limit);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    mysqli_stmt_close($stmt);
    return $products;
}

function updateProduct($id, $nama, $deskripsi, $harga, $stok, $gambar, $IDkategori)
{
    global $conn; // Menggunakan koneksi mysqli

    // Mempersiapkan nilai untuk disisipkan ke dalam query
    $id = mysqli_real_escape_string($conn, $id);
    $nama = mysqli_real_escape_string($conn, $nama);
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);
    $harga = mysqli_real_escape_string($conn, $harga);
    $stok = mysqli_real_escape_string($conn, $stok);
    $gambar = mysqli_real_escape_string($conn, $gambar);
    $IDkategori = mysqli_real_escape_string($conn, $IDkategori);

    // Query UPDATE
    $query = "UPDATE produk SET
                nama = '$nama',
                deskripsi = '$deskripsi',
                harga = '$harga',
                stok = '$stok',
                gambar = '$gambar',
                IDkategori = '$IDkategori'
              WHERE IDproduk = $id";

    // Mengeksekusi query
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}
/**
 * Fungsi untuk mengambil detail produk berdasarkan ID
 * 
 * @param int $id ID produk
 * @return array|false Array berisi detail produk atau false jika tidak ditemukan
 */
function get_product_by_id($id) {
    global $conn;
    
    $id = intval($id);  // Pastikan ID adalah integer
    
    $sql = "SELECT * FROM produk WHERE IDproduk = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}


// Fungsi untuk menambah kategori baru
function addCategory($nama)
{
    global $conn;

    $nama = mysqli_real_escape_string($conn, $nama);

    $query = "INSERT INTO kategori (namakategori) VALUES ('$nama')";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

// Fungsi untuk mendapatkan kategori 

function getCategory($id) {
    global $conn;
    $sql = "SELECT * FROM kategori WHERE IDkategori = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Fungsi untuk memperbarui kategori
function updateCategory($id, $nama)
{
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $nama = mysqli_real_escape_string($conn, $nama);

    $query = "UPDATE kategori SET namakategori = '$nama' WHERE IDkategori = '$id'";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

// Fungsi untuk menghapus kategori
function deleteCategory($id)
{
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $query = "DELETE FROM kategori WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

/**
 * Fungsi untuk mengambil detail layanan perbaikan berdasarkan ID
 * 
 * @param int $id ID layanan perbaikan
 * @return array|false Array berisi detail layanan perbaikan atau false jika tidak ditemukan
 */
function get_repair_service_by_id($id) {
    global $conn;
    $sql = "SELECT * FROM perbaikan WHERE IDperbaikan = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}


/**
 * Fungsi untuk menambahkan permintaan perbaikan baru
 * 
 * @param array $data Data permintaan perbaikan
 * @return bool True jika berhasil, false jika gagal
 */
function add_repair_request($data) {
    global $conn;

    $sql = "INSERT INTO perbaikan (nama_pelanggan, no_telp, email, jenis_perangkat, deskripsi_masalah, tanggal_masuk) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $data['nama_pelanggan'], $data['no_telp'], $data['email'], $data['jenis_perangkat'], $data['deskripsi_masalah']);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

/**
 * Fungsi untuk membersihkan input
 * 
 * @param string $data Data yang akan dibersihkan
 * @return string Data yang telah dibersihkan
 */
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

/**
 * Fungsi untuk mengenkripsi password
 * 
 * @param string $password Password yang akan dienkripsi
 * @return string Password yang telah dienkripsi
 */
function encrypt_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Fungsi untuk memeriksa password
 * 
 * @param string $password Password yang akan diperiksa
 * @param string $hashed_password Password terenkripsi dari database
 * @return bool True jika cocok, false jika tidak
 */
function verify_password($password, $hashed_password) {
    return password_verify($password, $hashed_password);
}

/**
 * Fungsi untuk menghasilkan token CSRF
 * 
 * @return string Token CSRF
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Fungsi untuk memvalidasi token CSRF
 * 
 * @param string $token Token yang akan divalidasi
 * @return bool True jika valid, false jika tidak
 */
function validate_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}