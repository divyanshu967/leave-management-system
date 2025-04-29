<?php
session_start();
// Protect the page
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login_form.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cancel Leave Request</title>
  <style>
    body { 
      font-family: 'Segoe UI', Tahoma, Verdana, sans-serif; 
      background: #eef2f7; 
      margin: 0; padding: 0; 
      display: flex; align-items: center; justify-content: center; 
      min-height: 100vh;
    }
    .form-box {
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      width: 360px;
    }
    h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }
    .form-box label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #555;
    }
    .form-box input {
      width: 100%;
      padding: 10px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }
    .form-box button {
      width: 100%;
      padding: 12px;
      background: #d9534f;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background .3s;
    }
    .form-box button:hover {
      background: #c9302c;
    }
    .back-link {
      text-align: center;
      margin-top: 15px;
    }
    .back-link a {
      color: #007bff;
      text-decoration: none;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="form-box">
    <h2>Cancel Leave</h2>
    <form action="cancel_leave_process.php" method="POST">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Proceed to Cancel</button>
    </form>
    <div class="back-link">
      <a href="../dashboard/employee_dashboard_form.php">← Back to Dashboard</a>
    </div>
  </div>

</body>
</html>
