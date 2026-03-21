<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    $folder = "uploads/";
    $fileName = time() . "_" . basename($_FILES['waste_image']['name']);
    $targetPath = $folder . $fileName;

    if (move_uploaded_file($_FILES['waste_image']['tmp_name'], $targetPath)) {
        
        // --- THE AI BRIDGE ---
        // Change "python" to "py" below if you are on Windows and it doesn't work
        $command = "python ai.classifier.py " . escapeshellarg($targetPath) . " 2>&1"; 
        $ai_output = shell_exec($command);
        
        // CLEAN THE DATA: This removes errors and keeps only the category word
        $waste_type = trim($ai_output);

        // If Python crashes, we use a safe word so the Database doesn't break
        if (empty($waste_type) || strlen($waste_type) > 20) {
            $waste_type = "General Waste";
        }

        // 3. Save to Database
        $sql = "INSERT INTO reports (location, description, image_path, waste_type) 
                VALUES ('$location', '$description', '$targetPath', '$waste_type')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    }
}
?>