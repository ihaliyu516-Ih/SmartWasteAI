<?php 
include 'db.php'; 

// 1. Get Dynamic Stats
$total_q = mysqli_query($conn, "SELECT COUNT(*) as total FROM reports");
$total_count = mysqli_fetch_assoc($total_q)['total'];

$plastic_q = mysqli_query($conn, "SELECT COUNT(*) as total FROM reports WHERE waste_type = 'Plastic'");
$plastic_count = mysqli_fetch_assoc($plastic_q)['total'];

$pending_q = mysqli_query($conn, "SELECT COUNT(*) as total FROM reports WHERE status = 'Pending'");
$pending_count = mysqli_fetch_assoc($pending_q)['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | SmartWaste AI</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8fafc; margin: 0; padding-top: 80px; }
        .navbar { background: white; padding: 15px 50px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: fixed; top: 0; width: 100%; z-index: 1000; box-sizing: border-box; }
        .nav-logo { font-weight: bold; color: #059669; font-size: 20px; }
        .nav-links a { margin-left: 20px; text-decoration: none; color: #64748b; font-weight: 500; }
        
        .container { max-width: 1100px; margin: 0 auto; padding: 20px; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-export { background: #1e293b; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; }

        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border-left: 5px solid #059669; }
        .card h3 { margin: 5px 0 0 0; font-size: 28px; color: #1e293b; }
        .card p { color: #64748b; margin: 0; font-size: 12px; font-weight: bold; text-transform: uppercase; }

        .table-container { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #f1f5f9; color: #475569; padding: 15px; text-align: left; font-size: 13px; }
        td { padding: 15px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .bg-green { background: #d1fae5; color: #065f46; }
        .bg-amber { background: #fef3c7; color: #92400e; }
        img { border-radius: 8px; object-fit: cover; border: 1px solid #e2e8f0; }
        .btn-delete { color: #ef4444; text-decoration: none; font-size: 12px; font-weight: bold; padding: 5px 10px; border: 1px solid #fecaca; border-radius: 5px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">SmartWaste AI</div>
        <div class="nav-links">
            <a href="index.php">Report Waste</a>
            <a href="dashboard.php" style="color: #059669; font-weight: bold;">Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="header-flex">
            <h2 style="color: #1e293b; margin:0;">Environmental Monitoring</h2>
            <a href="export_data.php" class="btn-export">📥 Download Excel Report</a>
        </div>

        <div class="stats-grid">
            <div class="card"><p>Total Reports</p><h3><?php echo $total_count; ?></h3></div>
            <div class="card" style="border-left-color: #3b82f6;"><p>Plastic Detected</p><h3><?php echo $plastic_count; ?></h3></div>
            <div class="card" style="border-left-color: #f59e0b;"><p>Pending Action</p><h3><?php echo $pending_count; ?></h3></div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Evidence</th>
                        <th>Location</th>
                        <th>AI Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM reports ORDER BY created_at DESC");
                    while($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>
                            <td><img src='{$row['image_path']}' width='45' height='45'></td>
                            <td><strong>{$row['location']}</strong></td>
                            <td><span class='badge bg-green'>{$row['waste_type']}</span></td>
                            <td><span class='badge bg-amber'>{$row['status']}</span></td>
                            <td style='color:#94a3b8; font-size:11px;'>{$row['created_at']}</td>
                            <td><a href='delete_report.php?id={$row['id']}' class='btn-delete' onclick=\"return confirm('Delete record?')\">Delete</a></td>
                        </tr>";
                    }
                    ?>
                </tbody>p
            </table>
        </div>
    </div>

    <footer style="margin-top: 50px; padding: 30px; text-align: center; background-color: #f1f5f9; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 14px; width: 100%; box-sizing: border-box;">
        <p style="margin: 0;">Build  for <strong> Environmental Impact</strong></p>
        <p style="font-weight: bold; color: #1e293b; margin: 5px 0; font-size: 16px;">Lead Developer: Isa Haruna Aliyu</p>
        <p style="font-size: 12px; margin-top: 5px;">3MTT NextGen Cohort 2026</p>
    </footer>
</body>
</html>