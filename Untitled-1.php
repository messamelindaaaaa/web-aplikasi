<?php
// Koneksi ke database
include('koneksi.php');

// Enable error reporting to debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize variables to avoid undefined errors
$no = $gunung = $mdpl = $provinsi = $status = "";

// Check if form is submitted for updating
if (isset($_POST['submit'])) {
    // Get data from form
    $no = $_POST['no'];
    $gunung = $_POST['gunung'];
    $mdpl = $_POST['mdpl'];
    $provinsi = $_POST['provinsi'];
    $status = $_POST['status'];

    // Update query
    $query_update = "UPDATE informasi SET gunung = ?, mdpl = ?, provinsi = ?, status = ? WHERE no = ?";

    // Prepare the query using prepared statements to avoid SQL injection
    if ($stmt = $koneksi->prepare($query_update)) {
        // Bind the parameters
        $stmt->bind_param("sisis", $gunung, $mdpl, $provinsi, $status, $no);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to tampil3.php after successful update
            header("Location: tampil3.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $koneksi->error;
    }
}

// Fetch the data to be updated based on `no`
if (isset($_GET['no']) && is_numeric($_GET['no'])) {
    $no = $_GET['no'];
    $query = "SELECT * FROM informasi WHERE no = ?";
    
    // Prepare and bind the statement to fetch the data
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("i", $no);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if record exists
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

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $koneksi->error;
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
                        <label for="no" class="form-label">No</label>
                        <input type="number" class="form-control" id="no" name="no" value="<?php echo $no; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="gunung" class="form-label">Gunung</label>
                        <input type="text" class="form-control" id="gunung" name="gunung" value="<?php echo htmlspecialchars($gunung); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mdpl" class="form-label">MDPL</label>
                        <input type="number" class="form-control" id="mdpl" name="mdpl" value="<?php echo htmlspecialchars($mdpl); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo htmlspecialchars($provinsi); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($status); ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
                    <a href="tampil3.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
