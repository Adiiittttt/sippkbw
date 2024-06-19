<?php
// config.php

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sippkbw');

// Koneksi ke database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset ke utf8
mysqli_set_charset($conn, "utf8");

// Di file config.php
define('BASE_URL', '/sippkbw'); // Sesuaikan dengan path instalasi Anda

// Konfigurasi umum
define('SITE_NAME', 'Computer Store & repair Solution');
define('ADMIN_EMAIL', 'admin@komputerstore.com');

// Zona waktu
date_default_timezone_set('Asia/Jakarta');

// Aktifkan atau nonaktifkan mode debug
define('DEBUG_MODE', true);

// Fungsi untuk menampilkan error (gunakan hanya untuk development)
function debug_mode() {
    if (DEBUG_MODE) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }
}

// Panggil fungsi debug_mode
debug_mode();

