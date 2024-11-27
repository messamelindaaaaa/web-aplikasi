<?php
// Koneksi ke database
include('koneksi.php');

// Proses hapus data jika ada parameter `hapus` di URL
if (isset($_GET['hapus'])) {
    $pendaftar = $_GET['hapus'];
    $query_hapus = "DELETE FROM pendaftar WHERE pendaftar = '$pendaftar'";
    $koneksi->query($query_hapus);
    header("Location: tampil1.php");
}

// Query untuk menampilkan data dari tabel `pendaftar`
$query = "SELECT * FROM pendaftar";
$data = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
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
            margin-bottom: 30px;
            background-color: #ffffff;
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
            border: 0;
        }
        .table th, .table td {
            padding: 12px 16px;
            text-align: center;
        }
        .table thead {
            background-color: #67b8ff; /* Light Blue for table header */
            color: white;
        }
        .table-bordered {
            border: none;
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
        .btn-next {
            background-color: #67b8ff; /* Light blue for 'Next' button */
            color: white;
            border: none;
            font-weight: 600;
        }
        .btn-next:hover {
            background-color: #4a94e3; /* Darker blue on hover */
        }
        .btn-outline-primary {
            border: 2px solid #007bff;
            color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        /* Scrollable table for smaller screens */
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Data Registrasi</h5>
            </div>
            <div class="card-body">
                <!-- Tombol Tambah Data -->
                <a href="tambah1.php" class="btn btn-outline-primary mb-3">Tambah Data</a>
                
                <!-- Tabel Data Pendaftar -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No Pendaftar</th>
                                <th>Nama</th>
                                <th>Gunung Tujuan</th>
                                <th>Masuk</th>
                                <th>Jumlah Orang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $data->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['pendaftar']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['tujuan']; ?></td>
                                <td><?php echo $row['masuk']; ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="ubah1.php?pendaftar=<?php echo $row['pendaftar']; ?>" class="btn btn-info btn-sm">Ubah</a>
                                        <a href="tampil1.php?hapus=<?php echo $row['pendaftar']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Next (Left aligned and Light Blue) -->
                <div class="text-left mt-4">
                    <a href="tampil2.php" class="btn btn-next btn-lg">Next</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for responsive navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
