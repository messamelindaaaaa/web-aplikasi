<?php
include('koneksi.php');

// Mendapatkan data pendaftar berdasarkan ID
if (isset($_GET['pendaftar'])) {
    $pendaftar = $_GET['pendaftar'];
    $query = "SELECT * FROM pendaftar WHERE pendaftar = '$pendaftar'";
    $result = $koneksi->query($query);
    $data = $result->fetch_assoc();
}

// Proses update data jika form dikirim
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tujuan = $_POST['tujuan'];
    $masuk = $_POST['masuk'];
    $jumlah = $_POST['jumlah'];
    
    $query = "UPDATE pendaftar SET nama='$nama', tujuan='$tujuan', masuk='$masuk', jumlah='$jumlah' WHERE pendaftar='$pendaftar'";
    $koneksi->query($query);
    
    header("Location: tampil1.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0c3fc, #8ec5fc);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            text-align: center;
            font-weight: bold;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            border-radius: 5px;
            padding: 8px 12px;
        }
        .btn-primary {
            background-color: #6a1b9a;
            border: none;
            padding: 10px;
            width: 100%;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #4a148c;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Ubah Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Gunung Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan" class="form-control" value="<?php echo htmlspecialchars($data['tujuan']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="masuk" class="form-label">Hari Masuk</label>
                        <input type="date" name="masuk" id="masuk" class="form-control" value="<?php echo htmlspecialchars($data['masuk']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Orang</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?php echo htmlspecialchars($data['jumlah']); ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="tampil1.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
