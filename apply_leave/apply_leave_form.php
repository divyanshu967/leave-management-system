<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header('../login/login_form_process.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apply for Leave</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
      margin: 0; padding: 0;
      display: flex; align-items: center; justify-content: center;
      min-height: 100vh;
    }
    .container {
      background: #fff; padding: 40px; border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2); width: 450px;
    }
    h1 {
      text-align: center; color: #333; margin-bottom: 30px;
    }
    form > div { margin-bottom: 20px; }
    label {
      display: block; margin-bottom: 8px;
      font-weight: 600; color: #555;
    }
    select, input[type="date"], textarea {
      width: 100%; padding: 12px; border: 1px solid #ccc;
      border-radius: 8px; box-sizing: border-box; font-size: 16px;
    }
    textarea { resize: vertical; }
    button {
      width: 100%; padding: 14px; background: #ff7e5f;
      color: #fff; border: none; border-radius: 8px;
      font-size: 18px; cursor: pointer; transition: background .3s;
      margin-top: 25px;
    }
    button:hover { background: #eb5757; }
    .back-link {
      text-align: center; margin-top: 20px;
    }
    .back-link a {
      color: #333; text-decoration: none; font-size: 15px;
    }
    .back-link a:hover { color: #ff7e5f; }
  </style>
</head>
<body>

  <div class="container">
    <h1>Apply for Leave</h1>

    <form action="apply_leave_process.php" method="POST">
      <div>
        <label for="leave_type">Leave Type:</label>
        <select name="leave_type" id="leave_type" required>
          <option value="">Select Leave Type</option>
          <option value="Privilege Leave (PL) or Earned Leave (EL)">Privilege Leave (PL) or Earned Leave (EL)</option>
          <option value="Casual Leave (CL)">Casual Leave (CL)</option>
          <option value="Sick Leave (SL)">Sick Leave (SL)</option>
          <option value="Maternity Leave (ML)">Maternity Leave (ML)</option>
          <option value="Compensatory Off (Comp-off)">Compensatory Off (Comp-off)</option>
          <option value="Marriage Leave">Marriage Leave</option>
          <option value="Paternity Leave">Paternity Leave</option>
          <option value="Bereavement Leave">Bereavement Leave</option>
          <option value="Loss of Pay (LOP) / Leave Without Pay (LWP)">Loss of Pay (LOP) / Leave Without Pay (LWP)</option>
        </select>
      </div>

      <div>
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>
      </div>

      <div>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>
      </div>

      <div>
        <label for="reason">Reason for Leave:</label>
        <textarea name="reason" id="reason" rows="4" required placeholder="Enter your reason..."></textarea>
      </div>

      <button type="submit">Submit Leave Request</button>
    </form>

    <div class="back-link">
      <a href="../dashboard/employee_dashboard_form.php">← Back to Dashboard</a>
    </div>
  </div>

</body>
</html>

