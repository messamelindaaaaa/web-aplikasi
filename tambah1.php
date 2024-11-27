<?php
// Menghubungkan file koneksi.php
include('koneksi.php');

// Proses simpan data jika form dikirim
if (isset($_POST['submit'])) {
    // Mengambil data dari form dan menghindari SQL Injection
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['tujuan']);
    $masuk = mysqli_real_escape_string($koneksi, $_POST['masuk']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    
    // Query untuk memasukkan data ke database
    $query = "INSERT INTO pendaftar (nama, tujuan, masuk, jumlah) 
    VALUES ('$nama', '$tujuan', '$masuk', '$jumlah')";

    // Menjalankan query dan memeriksa apakah query berhasil atau tidak
    if ($koneksi->query($query) === TRUE) {
        // Jika berhasil, redirect ke halaman tampil1.php
        header("Location: tampil1.php");
        exit;  // Pastikan setelah redirect, skrip tidak dilanjutkan
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global background color */
        body {
            background-color: #a8c0ff; /* Light blue */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        /* Centered container */
        .container {
            max-width: 500px;
            width: 100%;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #ffffff;
        }

        /* Header styling */
        .card-header {
            background-color: #007bff; /* Light blue */
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 1.25em;
        }

        /* Form labels */
        .form-label {
            color: #333;
            font-weight: bold;
        }

        /* Form fields */
        .form-control {
            border: 2px solid #007bff; /* Light blue */
            border-radius: 8px;
            padding: 10px;
            transition: 0.3s ease;
        }

        /* Field hover and focus */
        .form-control:focus,
        .form-control:hover {
            border-color: #0056b3; /* Darker blue */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Primary button */
        .btn-primary {
            background-color: #007bff; /* Light blue */
            border: none;
            font-weight: bold;
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            transition: background 0.3s;
        }

        /* Primary button hover */
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Secondary button */
        .btn-secondary {
            background-color: #757575;
            color: white;
            border: none;
            width: 100%;
            margin-top: 10px;
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Data Pendaftar
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <!-- Input Gunung Tujuan -->
                    <div class="mb-3">
                        <label class="form-label">Gunung Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" required>
                    </div>
                    <!-- Input Hari Masuk -->
                    <div class="mb-3">
                        <label class="form-label">Hari Masuk</label>
                        <input type="date" name="masuk" class="form-control" required>
                    </div>
                    <!-- Input Jumlah Orang -->
                    <div class="mb-3">
                        <label class="form-label">Jumlah Orang</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <!-- Tombol Simpan -->
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <!-- Tombol Kembali -->
                    <a href="tampil1.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
