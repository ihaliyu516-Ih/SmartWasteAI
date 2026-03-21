<?php
include 'db.php';

// 1. Tell the browser this is a CSV file download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Gombe_Waste_Report_'.date('Y-m-d').'.csv');

// 2. Open the "output" stream
$output = fopen('php://output', 'w');

// 3. Set the Column Headers
fputcsv($output, array('ID', 'Location', 'Waste Category', 'Status', 'Date Submitted'));

// 4. Fetch the data from your database
$query = "SELECT id, location, waste_type, status, created_at FROM reports ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>