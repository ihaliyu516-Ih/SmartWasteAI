<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartWaste AI | Report</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8fafc; margin: 0; padding-top: 80px; }
        .navbar { background: white; padding: 15px 50px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: fixed; top: 0; width: 100%; z-index: 1000; box-sizing: border-box; }
        .nav-logo { font-weight: bold; color: #059669; font-size: 20px; }
        .nav-links a { margin-left: 20px; text-decoration: none; color: #64748b; font-weight: 500; }
        
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        h2 { color: #1e293b; text-align: center; margin-top: 0; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #475569; font-weight: 600; font-size: 14px; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #059669; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        button:hover { background: #047857; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">SmartWaste AI</div>
        <div class="nav-links">
            <a href="index.php" style="color: #059669; font-weight: bold;">Report Waste</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h2>Smart Waste Report</h2>
        <p style="text-align:center; color:#64748b; font-size:14px;">AI-Powered Environmental Action</p>
        
        <form action="submit_report.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" placeholder="e.g. Dawaki Ward, Gombe" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" placeholder="Tell us more about the waste..."></textarea>
            </div>
            <div class="form-group">
                <label>Capture Image</label>
                <input type="file" name="waste_image" accept="image/*" required>
            </div>
            <button type="submit" name="submit">Analyze & Report</button>
        </form>
    </div>

    <footer style="margin-top: 50px; padding: 30px; text-align: center; background-color: #f1f5f9; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 14px; width: 100%; box-sizing: border-box;">
        <p style="margin: 0;">Developed with ❤️ for <strong>Gombe State Environmental Action</strong></p>
        <p style="font-weight: bold; color: #1e293b; margin: 5px 0; font-size: 16px;">Lead Developer: Isa Haruna Aliyu</p>
        <p style="font-size: 12px; margin-top: 5px;">3MTT NextGen Cohort 2026 | SIWES Industrial Project</p>
    </footer>

</body>
</html>