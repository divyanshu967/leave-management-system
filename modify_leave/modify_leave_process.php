<?php
session_start();

// Only allow logged-in users
if (!isset($_SESSION['name'])) {
    header('Location: ../login/login_form.php');
    exit();
}

require_once '../connection/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_SESSION['name']);
    $password = $conn->real_escape_string($_POST['password']);
    $start_date = $conn->real_escape_string($_POST['start_date']);

    // Find user with name and password
    $user_sql = "SELECT user_id FROM users WHERE name = '$name' AND password = '$password'";
    $user_result = $conn->query($user_sql);

    if ($user_result && $user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        $user_id = $user['user_id'];

        // Find leave with start date
        $leave_sql = "SELECT * FROM leave_requests WHERE user_id = '$user_id' AND start_date = '$start_date' AND status = 'Pending'";
        $leave_result = $conn->query($leave_sql);

        if ($leave_result && $leave_result->num_rows > 0) {
            $leave = $leave_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modify Leave</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 20px; }
    .container { background: #fff; padding: 30px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    input, select, textarea, button { width: 100%; padding: 12px; margin-top: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ccc; }
    button { background: #28a745; color: white; border: none; cursor: pointer; }
    button:hover { background: #218838; }
  </style>
</head>
<body>

<div class="container">
  <h2>Modify Leave Request</h2>
  <form action="update_leave_process.php" method="POST">
    <input type="hidden" name="leave_id" value="<?php echo $leave['leave_id']; ?>">

    <label>Leave Type:</label>
    <select name="leave_type" required>
      <option value="Privilege Leave (PL) or Earned Leave (EL)" <?php if($leave['leave_type']=='Privilege Leave (PL) or Earned Leave (EL)') echo 'selected'; ?>>Privilege Leave (PL) or Earned Leave (EL)</option>
      <option value="Casual Leave (CL)" <?php if($leave['leave_type']=='Casual Leave (CL)') echo 'selected'; ?>>Casual Leave (CL)</option>
      <option value="Sick Leave (SL)" <?php if($leave['leave_type']=='Sick Leave (SL)') echo 'selected'; ?>>Sick Leave (SL)</option>
      <option value="Maternity Leave (ML)" <?php if($leave['leave_type']=='Maternity Leave (ML)') echo 'selected'; ?>>Maternity Leave (ML)</option>
      <option value="Compensatory Off (Comp-off)" <?php if($leave['leave_type']=='Compensatory Off (Comp-off)') echo 'selected'; ?>>Compensatory Off (Comp-off)</option>
      <option value="Marriage Leave" <?php if($leave['leave_type']=='Marriage Leave') echo 'selected'; ?>>Marriage Leave</option>
      <option value="Paternity Leave" <?php if($leave['leave_type']=='Paternity Leave') echo 'selected'; ?>>Paternity Leave</option>
      <option value="Bereavement Leave" <?php if($leave['leave_type']=='Bereavement Leave') echo 'selected'; ?>>Bereavement Leave</option>
      <option value="Loss of Pay (LOP) / Leave Without Pay (LWP)" <?php if($leave['leave_type']=='Loss of Pay (LOP) / Leave Without Pay (LWP)') echo 'selected'; ?>>Loss of Pay (LOP) / Leave Without Pay (LWP)</option>
    </select>

    <label>Start Date:</label>
    <input type="date" name="start_date" value="<?php echo $leave['start_date']; ?>" required>

    <label>End Date:</label>
    <input type="date" name="end_date" value="<?php echo $leave['end_date']; ?>" required>

    <label>Reason:</label>
    <textarea name="reason" rows="4" required><?php echo $leave['reason']; ?></textarea>

    <button type="submit">Update Leave</button>
  </form>
</div>

</body>
</html>

<?php
        } else {
            echo "<h3 style='color:red;text-align:center;'>No Pending Leave Request found with that Start Date!</h3>";
        }
    } else {
        echo "<h3 style='color:red;text-align:center;'>Incorrect Password!</h3>";
    }
}
?>
