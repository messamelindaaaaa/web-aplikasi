<?php
// Koneksi ke database
include('koneksi.php');

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id = $_POST['id'];
    $gunung = $_POST['gunung'];
    $mdpl = $_POST['mdpl'];
    $provinsi = $_POST['provinsi'];
    $status = $_POST['status'];

    // Query untuk memperbarui data di tabel `informasi`
    $query = "UPDATE informasi SET gunung = '$gunung', mdpl = '$mdpl', provinsi = '$provinsi', status = '$status' WHERE id = '$id'";

    // Menjalankan query
    if ($koneksi->query($query)) {
        // Redirect ke halaman tampil3.php setelah data diperbarui
        header("Location: tampil3.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

// Ambil data yang akan diubah berdasarkan `id`
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM informasi WHERE id = '$id'";
    $result = $koneksi->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gunung = $row['gunung'];
        $mdpl = $row['mdpl'];
        $provinsi = $row['provinsi'];
        $status = $row['status'];
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Informasi Gunung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Ubah Data Informasi Gunung</h5>
            </div>
            <div class="card-body">
                <!-- Form untuk ubah data -->
                <form method="POST" action="ubah3.php">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID (Primary Key)</label>
                        <input type="number" class="form-control" id="id" name="id" value="<?php echo $id; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="gunung" class="form-label">Gunung</label>
                        <input type="text" class="form-control" id="gunung" name="gunung" value="<?php echo $gunung; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mdpl" class="form-label">Mdpl</label>
                        <input type="number" class="form-control" id="mdpl" name="mdpl" value="<?php echo $mdpl; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo $provinsi; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
                    <a href="tampil3.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
