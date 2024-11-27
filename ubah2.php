<?php
// Koneksi ke database
include('koneksi.php');

// Ambil no_sewa dari URL
if (isset($_GET['no_sewa'])) {
    $no_sewa = $_GET['no_sewa'];

    // Query untuk mengambil data berdasarkan no_sewa
    $query = "SELECT * FROM sewa WHERE no_sewa = '$no_sewa'";
    $result = $koneksi->query($query);
    $data = $result->fetch_assoc();

    // Proses update data jika form disubmit
    if (isset($_POST['submit'])) {
        $nama_penyewa = $_POST['nama_penyewa'];
        $jenis_barang = $_POST['jenis_barang'];
        $merk = $_POST['merk'];
        $durasi = $_POST['durasi'];

        // Query untuk update data
        $query_update = "UPDATE sewa SET nama_penyewa = '$nama_penyewa', jenis_barang = '$jenis_barang', merk = '$merk', durasi = '$durasi' WHERE no_sewa = '$no_sewa'";
        if ($koneksi->query($query_update)) {
            header("Location: tampil2.php"); // Redirect ke halaman tampil2.php setelah berhasil
        } else {
            echo "Error: " . $query_update . "<br>" . $koneksi->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sewa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0c3fc, #8ec5fc);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
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
                <h5 class="card-title mb-0">Edit Data Sewa</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="ubah2.php?no_sewa=<?php echo $no_sewa; ?>">
                    <div class="mb-3">
                        <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                        <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="<?php echo htmlspecialchars($data['nama_penyewa']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?php echo htmlspecialchars($data['jenis_barang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" value="<?php echo htmlspecialchars($data['merk']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Sewa</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" value="<?php echo htmlspecialchars($data['durasi']); ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="tampil2.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
