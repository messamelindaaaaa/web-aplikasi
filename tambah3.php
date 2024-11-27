<?php
// Koneksi ke database
include('koneksi.php');

// Enable error reporting to debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize variables to avoid undefined errors
$gunung = $mdpl = $provinsi = $status = "";

// Check if form is submitted for adding new data
if (isset($_POST['submit'])) {
    // Get data from form
    $gunung = $_POST['gunung'];
    $mdpl = $_POST['mdpl'];
    $provinsi = $_POST['provinsi'];
    $status = $_POST['status'];

    // Insert query
    $query_insert = "INSERT INTO informasi (gunung, mdpl, provinsi, status) VALUES (?, ?, ?, ?)";

    // Prepare the query using prepared statements to avoid SQL injection
    if ($stmt = $koneksi->prepare($query_insert)) {
        // Bind the parameters
        $stmt->bind_param("siss", $gunung, $mdpl, $provinsi, $status);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to tampil3.php after successful insertion
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
    <title>Tambah Data Informasi Gunung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global background */
        body {
            background: linear-gradient(45deg, #8E44AD, #3498DB); /* Purple to Blue gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        /* Center the form container */
        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        /* Card styling */
        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Card header */
        .card-header {
            background-color: #ADD8E6; /* Light Blue */
            color: white;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 20px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            letter-spacing: 1px;
        }

        /* Form styling */
        .form-label {
            font-weight: bold;
            color: #34495E;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #8E44AD; /* Purple border */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        /* Hover effect for form fields */
        .form-control:hover, .form-control:focus {
            border-color: #3498DB; /* Blue border */
            box-shadow: 0 0 12px rgba(52, 152, 219, 0.6);
        }

        /* Button styling */
        .btn-primary {
            background-color: #8E44AD;
            border: none;
            border-radius: 10px;
            width: 100%;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background 0.3s ease-in-out;
        }

        /* Button hover effect */
        .btn-primary:hover {
            background-color: #3498DB; /* Blue on hover */
        }

        .btn-secondary {
            background-color: #BDC3C7;
            color: #34495E;
            border-radius: 10px;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-size: 1rem;
        }

        /* Button secondary hover */
        .btn-secondary:hover {
            background-color: #7F8C8D;
        }

        /* Spacing */
        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Data Informasi Gunung
            </div>
            <div class="card-body">
                <form method="POST" action="tambah3.php">
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
                    <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
                    <a href="tampil3.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
