<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../login/login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #dff9fb, #c7ecee);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 100px auto;
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h1 {
      margin-bottom: 30px;
      color: #2c3e50;
    }

    .btn {
      display: block;
      width: 80%;
      margin: 20px auto;
      padding: 15px;
      font-size: 18px;
      color: white;
      background-color: #0984e3;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }

    .btn:hover {
      background-color: #0652dd;
    }

    .back {
      margin-top: 30px;
    }

    .back a {
      color: #2c3e50;
      text-decoration: none;
    }

    .back a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>User Management</h1>

    <a class="btn" href="delete_user_form.php">Delete User</a>
    <a class="btn" href="update_status_form.php">Update User Status</a>

    <div class="back">
      <a href="../dashboard/hr_dashboard_form.php">← Back to Dashboard</a>
    </div>
  </div>

</body>
</html>
