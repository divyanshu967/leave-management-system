<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modify Leave Request</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 20px; }
    .form-container { background: #fff; padding: 30px; border-radius: 10px; max-width: 400px; margin: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    input[type="password"], input[type="date"], button { width: 100%; padding: 12px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { background: #007bff; color: white; border: none; cursor: pointer; }
    button:hover { background: #0056b3; }
    .back-link { text-align: center; margin-top: 15px; }
    .back-link a { text-decoration: none; color: #007bff; }
  </style>
</head>
<body>

<h2 style="text-align:center;">Modify Your Leave</h2>

<div class="form-container">
  <form action="modify_leave_process.php" method="POST">
    <label for="password">Enter Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="start_date">Enter Start Date of Leave:</label>
    <input type="date" name="start_date" id="start_date" required>

    <button type="submit">Find Leave</button>
  </form>

  <div class="back-link">
    <a href="../dashboard/employee_dashboard_form.php">← Back to Dashboard</a>
  </div>
</div>

</body>
</html>
