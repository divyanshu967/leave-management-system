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
  <title>Update User Status</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      background: linear-gradient(to right, #dfe9f3, #ffffff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 80px auto;
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #333;
      font-weight: bold;
    }

    input[type="text"], select {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Update User Status</h2>
  <form action="update_user_status.php" method="POST">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" id="user_id" required>

    <label for="name">User Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="status">New Status:</label>
    <select name="status" id="status" required>
      <option value="">-- Select Status --</option>
      <option value="active">Active</option>
      <option value="inactive">Inactive</option>
    </select>

    <button type="submit">Update Status</button>
  </form>

  <div class="back-link">
    <a href="add_deleteuser.php">← Press to go back</a>
  </div>
</div>

</body>
</html>
