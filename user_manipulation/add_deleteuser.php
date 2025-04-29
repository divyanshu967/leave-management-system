<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../login/login_form.php"); // Redirect if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manipulation - Admin Panel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 40px;
            color: #2c3e50;
        }

        .button {
            display: block;
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            font-size: 18px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .back-link {
            margin-top: 30px;
        }

        .back-link a {
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Management</h1>

    <a href="add_user_form.php" class="button">➔ Add User</a>
    <a href="delete_update_status.php" class="button">➔ Delete or Update Status</a>

    <div class="back-link">
        <a href="../dashboard/hr_dashboard_form.php">← Back to Admin Dashboard</a>
    </div>
</div>

</body>
</html>
