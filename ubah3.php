<?php
// Include database connection
include('koneksi.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the update form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the data from POST request
    $no = $_POST['no'];
    $mdpl = $_POST['mdpl'];
    $gunung = $_POST['gunung'];
    $provinsi = $_POST['provinsi'];
    $status = $_POST['status'];

    // Update query with prepared statements
    $query_update = "UPDATE informasi SET mdpl = ?, gunung = ?, provinsi = ?, status = ? WHERE no = ?";

    if ($stmt = $koneksi->prepare($query_update)) {
        // Bind parameters
        $stmt->bind_param("ssssi", $mdpl, $gunung, $provinsi, $status, $no);

        // Execute and check if successful
        if ($stmt->execute()) {
            // Redirect to the main page if update is successful
            header("Location: tampil3.php");
            exit;
        } else {
            // Display error if query fails
            echo "Error executing update query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Display error if preparation fails
        echo "Error preparing update query: " . $koneksi->error;
    }
} else if (isset($_GET['no']) && is_numeric($_GET['no'])) {
    // Get the current data if `no` is set for the update form
    $no = $_GET['no'];
    $query = "SELECT * FROM informasi WHERE no = ?";
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("i", $no);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
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
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card h5 {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            border-radius: 6px;
            padding: 10px;
        }
        .btn-primary {
            background-color: #67b8ff;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #4a94e3;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h5>Edit Data Informasi Gunung</h5>
        <form method="POST">
            <input type="hidden" name="no" value="<?php echo htmlspecialchars($data['no']); ?>">
            
            <div class="mb-3">
                <label for="mdpl" class="form-label">MDPL</label>
                <input type="text" class="form-control" id="mdpl" name="mdpl" value="<?php echo htmlspecialchars($data['mdpl']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="gunung" class="form-label">Gunung</label>
                <input type="text" class="form-control" id="gunung" name="gunung" value="<?php echo htmlspecialchars($data['gunung']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo htmlspecialchars($data['provinsi']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($data['status']); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="tampil3.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
