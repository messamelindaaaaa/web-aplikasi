<?php 
session_start();
include 'koneksi.php';

// Cek apakah variabel `username` dan `password` sudah di-set di POST
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Ambil nilai username dan password dari form
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Menyeleksi data pada tabel login sesuai username
    $data = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username'");

    // Cek apakah data ditemukan
    if (mysqli_num_rows($data) > 0) {
        $row = mysqli_fetch_assoc($data);

        // Verifikasi password (gunakan password_verify jika terenkripsi)
        if ($password === $row['password']) { // ganti dengan `password_verify($password, $row['password'])` jika terenkripsi
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header("location:beranda.php");
            exit();
        } else {
            echo "<script>alert('Login gagal! Password tidak benar.');</script>";
            echo "<script>window.location = 'formlogin.php';</script>";
        }
    } else {
        echo "<script>alert('Login gagal! Username tidak ditemukan.');</script>";
        echo "<script>window.location = 'formlogin.php';</script>";
    }
} else {
    echo "<script>alert('Harap masukkan username dan password.');</script>";
    echo "<script>window.location = 'formlogin.php';</script>";
}
?>
