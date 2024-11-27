<?php
include('koneksi.php');

// Mendapatkan data pendaftar berdasarkan ID
if (isset($_GET['pendaftar'])) {
    $pendaftar = $_GET['pendaftar'];
    $query = "SELECT * FROM pendaftar WHERE pendaftar = '$pendaftar'";
    $result = $koneksi->query($query);
    
    // Memeriksa apakah data ada
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data jika form dikirim
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tujuan = $_POST['tujuan'];
    $masuk = $_POST['masuk'];
    $jumlah = $_POST['jumlah'];
    
    // Query update untuk memperbarui data pendaftar di database
    $query_update = "UPDATE pendaftar SET 
                        nama='$nama', 
                        tujuan='$tujuan', 
                        masuk='$masuk', 
                        jumlah='$jumlah' 
                     WHERE pendaftar='$pendaftar'";
    $koneksi->query($query_update);
    
    // Redirect ke halaman utama setelah update
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
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Ubah Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Gunung Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" value="<?php echo $data['tujuan']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Hari Masuk</label>
                        <input type="date" name="masuk" class="form-control" value="<?php echo $data['masuk']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah Orang</label>
                        <input type="number" name="jumlah" class="form-control" value="<?php echo $data['jumlah']; ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="tampil1.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
