<?php
// Koneksi ke database
include('koneksi.php');

// Cek apakah ada parameter `no_sewa` di URL untuk mengidentifikasi data yang akan diupdate
if (isset($_GET['no_sewa'])) {
    $no_sewa = $_GET['no_sewa'];

    // Ambil data yang ada berdasarkan `no_sewa`
    $query = "SELECT * FROM sewa WHERE no_sewa = '$no_sewa'";
    $result = $koneksi->query($query);
    $data = $result->fetch_assoc();

    // Jika form di-submit
    if (isset($_POST['submit'])) {
        $nama_penyewa = $_POST['nama_penyewa'];
        $jenis_barang = $_POST['jenis_barang'];
        $merk = $_POST['merk'];
        $durasi = $_POST['durasi'];

        // Query untuk update data
        $query_update = "UPDATE sewa SET nama_penyewa = '$nama_penyewa', jenis_barang = '$jenis_barang', merk = '$merk', durasi = '$durasi' WHERE no_sewa = '$no_sewa'";
        
        if ($koneksi->query($query_update)) {
            // Redirect setelah berhasil update
            header("Location: tampil2.php");
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
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Edit Data Sewa</h5>
            </div>
            <div class="card-body">
                <!-- Form untuk edit data sewa -->
                <form method="POST" action="update2.php?no_sewa=<?php echo $no_sewa; ?>">
                    <div class="mb-3">
                        <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                        <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="<?php echo $data['nama_penyewa']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?php echo $data['jenis_barang']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" value="<?php echo $data['merk']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Sewa</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" value="<?php echo $data['durasi']; ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="tampil2.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
