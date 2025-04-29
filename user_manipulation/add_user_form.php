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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add New User</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #e0ecf8, #ffffff);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    form label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    form input,
    form select {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    form button {
      width: 100%;
      padding: 14px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    form button:hover {
      background-color: #2980b9;
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #3498db;
      text-decoration: none;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add New User</h2>
    <form action="add_user_process.php" method="POST">
      <label for="name">Username</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required />

      <label for="confirm_password">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required />

      <label for="role">Role</label>
      <select id="role" name="role" required>
        <option value="">Select Role</option>
        <option value="employee">Employee</option>
        <option value="admin">Admin</option>
      </select>

      <label for="status">Status</label>
      <select id="status" name="status" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>

      <button type="submit">Add User</button>
    </form>

    <div class="back-link">
      <a href="add_deleteuser.php">← Back to User Management</a>
    </div>
  </div>
</body>
</html>
