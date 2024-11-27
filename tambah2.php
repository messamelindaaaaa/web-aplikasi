<?php
// Koneksi ke database
include('koneksi.php');

// Proses tambah data jika form disubmit
if (isset($_POST['submit'])) {
    $nama_penyewa = $_POST['nama_penyewa'];
    $jenis_barang = $_POST['jenis_barang'];
    $merk = $_POST['merk'];
    $durasi = $_POST['durasi'];

    // Query untuk insert data
    $query_tambah = "INSERT INTO sewa (nama_penyewa, jenis_barang, merk, durasi) VALUES ('$nama_penyewa', '$jenis_barang', '$merk', '$durasi')";
    if ($koneksi->query($query_tambah)) {
        header("Location: tampil2.php"); // Redirect ke halaman tampil2.php setelah berhasil
    } else {
        echo "Error: " . $query_tambah . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Sewa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global background color */
        body {
            background-color: #e0f7fa; /* Soft light cyan */
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
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        /* Header styling */
        .card-header {
            background-color: #4db6ac; /* Soft teal */
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 1.25em;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        /* Form labels */
        .form-label {
            color: #333;
            font-weight: bold;
        }

        /* Form fields */
        .form-control {
            border: 2px solid #4db6ac; /* Soft teal border */
            border-radius: 8px;
            padding: 10px;
            transition: 0.3s ease;
        }

        /* Field hover and focus */
        .form-control:focus,
        .form-control:hover {
            border-color: #00897b; /* Darker teal */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Primary button */
        .btn-primary {
            background-color: #4db6ac; /* Soft teal */
            border: none;
            font-weight: bold;
            width: 100%;
            border-radius: 8px;
            padding: 12px;
            transition: background 0.3s;
        }

        /* Primary button hover */
        .btn-primary:hover {
            background-color: #00897b; /* Darker teal */
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
            padding: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Data Sewa
            </div>
            <div class="card-body">
                <form method="POST" action="tambah2.php">
                    <div class="mb-3">
                        <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                        <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Sewa</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <a href="tampil2.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
