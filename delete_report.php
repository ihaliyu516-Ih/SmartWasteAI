<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 1. Get the image path first so we can delete the file from the folder too
    $query = "SELECT image_path FROM reports WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        unlink($row['image_path']); // This deletes the actual photo file
    }

    // 2. Delete the record from the database
    $delete_query = "SELECT * FROM reports WHERE id = $id"; // Basic check
    mysqli_query($conn, "DELETE FROM reports WHERE id = $id");
}

// Go back to the dashboard
header("Location: dashboard.php");
exit();
?>