<?php
session_start();

// 1. Check if admin is logged in (you can modify based on your session variable)
if (!isset($_SESSION['name'])) {
    header('Location: ../login/login_form.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Check Employee Leave Info</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #eef2f7;
      padding: 40px;
    }
    .container {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }
    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: bold;
      color: #333;
    }
    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }
    .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }
    button {
      flex: 1;
      padding: 10px 0;
      margin: 0 5px;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
    .view-balance {
      background-color: #007bff;
    }
    .view-balance:hover {
      background-color: #0056b3;
    }
    .view-history {
      background-color: #28a745;
    }
    .view-history:hover {
      background-color: #1e7e34;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Check Employee's Leave Information</h2>
    <form action="#" method="post" id="checkForm">
      <label for="user_id">Employee's ID:</label>
      <input type="number" id="user_id" name="user_id" required>

      <label for="name">Employee's Name:</label>
      <input type="text" id="name" name="name" required>

      <div class="button-group">
        <button type="submit" class="view-balance" formaction="view_balance_admin.php">View Balance</button>
        <button type="submit" class="view-history" formaction="view_history_admin.php">View History</button>
      </div>
    </form>
  </div>

</body>
</html>
