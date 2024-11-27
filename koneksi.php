<?php
// Koneksi ke database
$host = 'localhost';  // Atau gunakan IP server jika menggunakan server remote
$username = 'root';   // Username untuk MySQL
$password = '';       // Password untuk MySQL (jika ada)
$database = 'dbpemweb';  // Ganti dengan nama database yang sesuai

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Cek apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
