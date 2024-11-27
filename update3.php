<?php
// Koneksi ke database
include('koneksi.php');

// Enable error reporting to debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize variables with empty values
$gunung = $mdpl = $provinsi = $status = "";

// Check if the ID is set in the URL (using 'no' instead of 'id_pembeda')
if (isset($_GET['no']) && is_numeric($_GET['no'])) {
    $no = $_GET['no'];

    // Query to get the data for the specific 'no'
    $query = "SELECT * FROM informasi WHERE no = ?";
    if ($stmt = $koneksi->prepare($query)) {
        // Bind the 'no' parameter to the prepared statement
        $stmt->bind_param("i", $no);

        // Execute the query and fetch the result
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Fetch the row data
                $row = $result->fetch_assoc();
                $gunung = $row['gunung'];
                $mdpl = $row['mdpl'];
                $provinsi = $row['provinsi'];
                $status = $row['status'];  // Ensure the status is properly set
            } else {
                echo "Data tidak ditemukan.";
                exit;
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $koneksi->error;
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get data from the form
    $gunung = $_POST['gunung'];
    $mdpl = $_POST['mdpl'];
    $provinsi = $_POST['provinsi'];
    $status = $_POST['status'];  // Ensure this field is properly received

    // Debugging: Check the value of 'status' before updating
    echo "Status value before update: " . $status;  // Debugging line

    // Update query (using 'no' as the primary key)
    $query_update = "UPDATE informasi SET gunung = ?, mdpl = ?, provinsi = ?, status = ? WHERE no = ?";

    // Prepare the query using prepared statements to avoid SQL injection
    if ($stmt = $koneksi->prepare($query_update)) {
        // Bind the parameters (use "i" for integer, "s" for string, and so on)
        $stmt->bind_param("sisss", $gunung, $mdpl, $provinsi, $status, $no);

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
                <!-- Form untuk update data -->
                <form method="POST" action="update3.php?no=<?php echo $no; ?>">
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
                        <!-- Use a select input if status has specific values -->
                        <select name="status" id="status" class="form-control" required>
                            <option value="Aktif" <?php echo ($status == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Non-Aktif" <?php echo ($status == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                            <option value="Dormant" <?php echo ($status == 'Dormant') ? 'selected' : ''; ?>>Dormant</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
                    <a href="tampil3.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
