<?php
// Koneksi ke database
include('koneksi.php');

// Enable error reporting to debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Query untuk menampilkan data dari tabel `informasi`
$query = "SELECT * FROM informasi";
$data = $koneksi->query($query);

// Check if `no` is set in the URL and is numeric
if (isset($_GET['no']) && is_numeric($_GET['no'])) {
    $no = $_GET['no'];

    // Query to delete data based on no
    $query_delete = "DELETE FROM informasi WHERE no = ?";

    // Prepare the query using prepared statements to avoid SQL injection
    if ($stmt = $koneksi->prepare($query_delete)) {
        // Bind the parameter 'no' to the prepared statement
        $stmt->bind_param("i", $no);

        // Execute the query
        if ($stmt->execute()) {
            // Check if any rows were affected (successful deletion)
            if ($stmt->affected_rows > 0) {
                // Successful deletion, redirect after a short delay
                header("Location: tampil3.php");
                exit;
            } else {
                // No rows were affected (ID might not exist)
                echo "Data tidak ditemukan atau sudah dihapus.";
            }
        } else {
            // If the query execution fails
            echo "Error executing query: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If preparing the query fails
        echo "Error preparing the query: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Status Gunung</title>
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
                <h5 class="card-title mb-0">Data Informasi Status Gunung</h5>
            </div>
            <div class="card-body">
                <!-- Tombol Tambah Data -->
                <a href="tambah3.php" class="btn btn-outline-primary mb-3">Tambah Data</a>
                
                <!-- Tabel Data Informasi Gunung -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>MDPL</th>
                            <th>Gunung</th>
                            <th>Provinsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $data->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['no']; ?></td>
                            <td><?php echo $row['mdpl']; ?></td>
                            <td><?php echo $row['gunung']; ?></td>
                            <td><?php echo $row['provinsi']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <!-- Aksi: Ubah dan Hapus -->
                                <a href="ubah3.php?no=<?php echo $row['no']; ?>" class="btn btn-info btn-sm">Ubah</a>
                                <!-- Hapus Data -->
                                <a href="tampil3.php?no=<?php echo $row['no']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Tombol Navigation -->
                <div class="footer-buttons">
                    <a href="tampil2.php" class="btn btn-back">Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for responsive navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
