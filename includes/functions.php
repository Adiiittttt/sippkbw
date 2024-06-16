<?php
// functions.php

// Pastikan file ini hanya dijalankan dalam konteks yang benar
if (!defined('DB_HOST')) {
    exit('Akses langsung ke file ini tidak diizinkan.');
}

/**
 * Fungsi untuk mengambil produk unggulan
 * 
 * @param int $limit Jumlah produk yang akan diambil
 * @return array Array dari produk unggulan
 */
function get_featured_products($limit = 3) {
    global $conn;
    $products = [];

    // Mengambil produk berdasarkan kriteria lain, misalnya yang terbaru
    $sql = "SELECT * FROM produk ORDER BY IDproduk DESC LIMIT ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    mysqli_stmt_close($stmt);
    return $products;
}

/**
 * Fungsi untuk mengambil semua kategori
 * 
 * @return array Array dari kategori
 */
function get_all_categories() {
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

    $sql = "SELECT * FROM produk WHERE IDkategori = ? LIMIT ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $IDkategori, $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    mysqli_stmt_close($stmt);
    return $products;
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

/**
 * Fungsi untuk mengambil detail layanan perbaikan berdasarkan ID
 * 
 * @param int $id ID layanan perbaikan
 * @return array|false Array berisi detail layanan perbaikan atau false jika tidak ditemukan
 */
function get_repair_service_by_id($id) {
    global $conn;
    
    $id = intval($id);  // Pastikan ID adalah integer
    
    $sql = "SELECT * FROM perbaikan WHERE IDperbaikan = ?";
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