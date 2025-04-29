<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../login/login_form.php");
    exit();
}
$username = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #f0f4f8, #dbe9f4);
      margin: 0;
      padding: 0;
    }

    .container {
      text-align: center;
      padding: 60px 20px 60px; /* Increased top padding to push welcome text lower */
    }

    h1 {
      font-size: 32px;
      color: #2c3e50;
      margin-bottom: 0;
    }

    .circle-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 80px;
      margin-top: 100px;
    }

    .circle {
      width: 250px;
      height: 250px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: white;
      cursor: pointer;
      transition: transform 0.3s ease;
      font-weight: bold;
      text-align: center;
      padding: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .circle:hover {
      transform: scale(1.08);
    }

    .circle-1 { background-color: #3a7bd5; } /* Royal Blue */
    .circle-2 { background-color: #2d9cdb; } /* Sky Blue */
    .circle-3 { background-color: #1c92d2; } /* Dodger Blue */
    .circle-4 { background-color: #2779bd; } /* Steel Blue */

    .logout-btn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 12px 25px;
      background-color: #c0392b;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .logout-btn:hover {
      background-color: #a93226;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome Admin, <?php echo htmlspecialchars($username); ?>!</h1>

    <div class="circle-container">
      <div class="circle circle-1" onclick="window.location.href='../user_manipulation/add_deleteuser.php'">Users Management</div>
      <div class="circle circle-2" onclick="window.location.href='../manage_leave/manage_leave_form.php'">Manage Leaves</div>
      <div class="circle circle-3" onclick="window.location.href='../view_balance_history/view_balance_history_form.php'">User Leave Balance & History</div>
      <div class="circle circle-4" onclick="window.location.href='../leave_policies/leave_policies_admin.php'">Leave Policies</div>
    </div>

    <button class="logout-btn" onclick="window.location.href='../login/login_form.php'">Logout</button>
  </div>
</body>
</html>
