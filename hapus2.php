<?php
// Koneksi ke database
include('koneksi.php');

// Check if `id` is set in the URL and is a valid numeric value
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete query using a prepared statement to avoid SQL injection
    $query = "DELETE FROM sewa WHERE id = ?";
    
    // Check if the prepared statement can be executed
    if ($stmt = $koneksi->prepare($query)) {
        // Bind the parameter 'id' as an integer
        $stmt->bind_param("i", $id);

        // Execute the query
        if ($stmt->execute()) {
            // Check if any rows were affected (i.e., the record was deleted)
            if ($stmt->affected_rows > 0) {
                // Redirect to tampil2.php after successful deletion
                header("Location: tampil2.php");
                exit;
            } else {
                // If no rows were affected (ID might not exist)
                echo "Data tidak ditemukan atau sudah dihapus.";
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $koneksi->error;
    }
} else {
    // If `id` is not set or invalid, display an error
    echo "ID tidak ditemukan atau tidak valid.";
}
?>
