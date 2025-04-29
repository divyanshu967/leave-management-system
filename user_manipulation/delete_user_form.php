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
  <title>Delete User - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #fceabb, #f8b500);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 80px auto;
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-top: 20px;
      font-weight: bold;
      color: #555;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .btn {
      display: block;
      width: 100%;
      margin-top: 30px;
      padding: 12px;
      background-color: #d63031;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #c0392b;
    }

    .back-link {
      margin-top: 20px;
      text-align: center;
    }

    .back-link a {
      color: #333;
      text-decoration: none;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Delete User</h2>
  <form action="delete_user_process.php" method="POST">
    <label for="user_id">User ID:</label>
    <input type="text" id="user_id" name="user_id" required>

    <label for="name">User Name:</label>
    <input type="text" id="name" name="name" required>

    <button type="submit" class="btn">Delete User</button>
  </form>

  <div class="back-link">
    <a href="add_deleteuser.php">← Back to User Management</a>
  </div>
</div>

</body>
</html>
