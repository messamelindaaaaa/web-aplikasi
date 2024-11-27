<?php
// Koneksi ke database
include('koneksi.php');

// Enable error reporting to debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if 'id_pembeda' is set in the URL and is numeric
if (isset($_GET['id_pembeda']) && is_numeric($_GET['id_pembeda'])) {
    $id = $_GET['id_pembeda'];

    // Prepare the delete query
    $query_delete = "DELETE FROM informasi WHERE id_pembeda = ?";

    // Prepare the query using prepared statements to avoid SQL injection
    if ($stmt = $koneksi->prepare($query_delete)) {
        // Bind the parameter 'id_pembeda' to the prepared statement
        $stmt->bind_param("i", $id);

        // Execute the query
        if ($stmt->execute()) {
            // Check if any rows were affected (successful deletion)
            if ($stmt->affected_rows > 0) {
                // Successful deletion
                echo "Data berhasil dihapus.";
                // Redirect to tampil3.php after successful deletion
                header("Location: tampil3.php");
                exit;
            } else {
                // No rows were affected (ID might not exist)
                echo "Data tidak ditemukan atau sudah dihapus.";
            }
        } else {
            // If query execution fails
            echo "Error executing query: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If preparing the query fails
        echo "Error preparing the query: " . $koneksi->error;
    }
} else {
    // If 'id_pembeda' is not set or invalid, display an error
    echo "ID tidak ditemukan atau tidak valid.";
}
?>
