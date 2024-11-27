<?php
// Koneksi ke database
include('koneksi.php');

// Query untuk menampilkan data dari tabel `sewa`
$query = "SELECT * FROM sewa";
$data = $koneksi->query($query);

// Proses hapus data jika ada parameter `hapus` di URL
if (isset($_GET['hapus'])) {
    $no_sewa = $_GET['hapus'];
    $query_hapus = "DELETE FROM sewa WHERE no_sewa = '$no_sewa'";
    $koneksi->query($query_hapus);
    // Redirect ke halaman tampil2.php setelah data dihapus
    header("Location: tampil2.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outdoor Gear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #a1c4fd, #c2e9fb); /* Light Blue Gradient */
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background-color: #ffffff;
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #67b8ff; /* Light Blue for card header */
            color: white;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
            border: none; /* Remove the table border */
        }
        .table th, .table td {
            padding: 12px 16px;
            text-align: center;
            border: none; /* Remove the cell borders */
        }
        .table thead {
            background-color: #67b8ff; /* Light Blue for table header */
            color: white;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #d9efff; /* Very light blue for odd rows */
        }
        .table-striped tbody tr:nth-child(even) {
            background-color: #c3e4ff; /* Light blue for even rows */
        }
        .table-striped tbody tr:hover {
            background-color: #9bc8e5; /* Slightly darker blue for hover effect */
        }
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-info {
            background-color: #67b8ff; /* Light blue for "Ubah" button */
            border: none;
            color: white;
        }
        .btn-danger {
            background-color: #f57373; /* Soft red for "Hapus" button */
            border: none;
            color: white;
        }
        .btn-next, .btn-back {
            background-color: #67b8ff; /* Light blue for 'Next' and 'Back' buttons */
            color: white;
            border: none;
            font-weight: 600;
        }
        .btn-next:hover, .btn-back:hover {
            background-color: #4a94e3; /* Darker blue on hover */
        }
        .footer-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Outdoor Gear</h5>
            </div>
            <div class="card-body">
                <!-- Tombol Tambah Data -->
                <a href="tambah2.php" class="btn btn-outline-primary mb-3">Tambah Data</a>
                
                <!-- Tabel Data Sewa -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No Sewa</th>
                            <th>Nama Penyewa</th>
                            <th>Jenis Barang</th>
                            <th>Merk</th>
                            <th>Durasi </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $data->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['no_sewa']; ?></td>
                            <td><?php echo $row['nama_penyewa']; ?></td>
                            <td><?php echo $row['jenis_barang']; ?></td>
                            <td><?php echo $row['merk']; ?></td>
                            <td><?php echo $row['durasi']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="ubah2.php?no_sewa=<?php echo $row['no_sewa']; ?>" class="btn btn-info btn-sm">Ubah</a>
                                    <a href="tampil2.php?hapus=<?php echo $row['no_sewa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Tombol Navigation -->
                <div class="footer-buttons">
                    <a href="tampil1.php" class="btn btn-back">Back</a>
                    <a href="tampil3.php" class="btn btn-next">Next</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for responsive navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
