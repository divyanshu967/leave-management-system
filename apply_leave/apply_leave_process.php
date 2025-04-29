<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:../login/login_form.php');
    exit();
}
require_once '../connection/db_connect.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id    = $_SESSION['user_id'];
    $leave_type = $conn->real_escape_string($_POST['leave_type']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date   = $conn->real_escape_string($_POST['end_date']);
    $reason     = $conn->real_escape_string($_POST['reason']);

    // 1. Define the allowed leave types
    $valid_types = [
      'Privilege Leave (PL) or Earned Leave (EL)',
      'Casual Leave (CL)',
      'Sick Leave (SL)',
      'Maternity Leave (ML)',
      'Compensatory Off (Comp-off)',
      'Marriage Leave',
      'Paternity Leave',
      'Bereavement Leave',
      'Loss of Pay (LOP) / Leave Without Pay (LWP)'
    ];

    // 2. Validate the submitted leave type
    if (!in_array($leave_type, $valid_types)) {
        die('<p style="color:red; text-align:center;">Invalid leave type selected.</p>');
    }

    // 3. Insert into leave_requests
    $sql = "
      INSERT INTO leave_requests 
        (user_id, leave_type, start_date, end_date, reason)
      VALUES 
        ('$user_id', '$leave_type', '$start_date', '$end_date', '$reason')
    ";

    if ($conn->query($sql)) {
      echo <<<HTML
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Leave Application Submitted</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0; padding: 0;
        display: flex; justify-content: center; align-items: center;
        height: 100vh;
      }
      .message-box {
        background: #fff;
        padding: 30px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 400px;
        width: 100%;
      }
      .message-box h2 {
        color: #4CAF50;
        margin-bottom: 15px;
      }
      .message-box p {
        color: #555;
        line-height: 1.5;
        margin-bottom: 20px;
      }
      .message-box .btn {
        display: inline-block;
        padding: 10px 20px;
        background: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background 0.3s ease;
      }
      .message-box .btn:hover {
        background: #43a047;
      }
    </style>
  </head>
  <body>
    <div class="message-box">
      <h2>Leave Request Submitted</h2>
      <p>Your leave application has been received and is now pending approval.</p>
      <p>You will be redirected to your dashboard shortly.</p>
      <a class="btn" href="../dashboard/employee_dashboard_form.php">Go to Dashboard Now</a>
    </div>
  </body>
  </html>
  HTML;
  
      // redirect after 5 seconds
      header("Refresh: 5; URL=../dashboard/employee_dashboard_form.php");
  
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Database error: " . $conn->error . "</p>";
    }
}

// If not a POST request, send back to form
header('Location: apply_leave_form.php');
exit();
?>
