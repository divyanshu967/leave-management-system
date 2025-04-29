<?php
session_start();
require_once '../connection/db_connect.php';

// 1. Ensure form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['email'], $_POST['password'])) {
    header('Location: cancel_leave_form.php');
    exit();
}

// 2. Sanitize input values
$email    = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);  // Password entered by the user

// 3. Query to find user by email
$user_sql = "
  SELECT user_id, password
    FROM users
   WHERE email = '$email'
     AND status = 'active'
";
$user_res = $conn->query($user_sql);

// 4. If no user is found, show error
if (!$user_res || $user_res->num_rows === 0) {
    echo "<p style='color:red;text-align:center;'>No account found with that email.</p>";
    echo "<p style='text-align:center;'><a href='cancel_leave_form.php'>Try Again</a></p>";
    exit();
}

// 5. Verify password by direct comparison (no hashing)
$user_row = $user_res->fetch_assoc();
if ($password !== $user_row['password']) {
    echo "<p style='color:red;text-align:center;'>Incorrect password.</p>";
    echo "<p style='text-align:center;'><a href='cancel_leave_form.php'>Try Again</a></p>";
    exit();
}

// 6. Password verified, proceed with fetching leaves
$user_id = $user_row['user_id'];

// 7. Fetch pending or approved leave requests (end_date > current date)
$leave_sql = "
  SELECT leave_id, leave_type, start_date, end_date, reason, status
    FROM leave_requests
   WHERE user_id = '$user_id'
     AND start_date >= CURDATE()
     AND status IN ('Pending', 'Approved')
";
$leave_res = $conn->query($leave_sql);

// 8. Check if there are any matching leave requests
if ($leave_res->num_rows === 0) {
    echo "<p style='color:red;text-align:center;'>No pending or approved leave requests found.</p>";
    exit();
}

// 9. Display leave requests and provide cancel option
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Leave Requests</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 20px; }
        .container { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 12px; text-align: left; }
        button { background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #c82333; }
    </style>
</head>
<body>

<div class="container">
    <h2>Your Pending/Approved Leave Requests</h2>
    <table>
        <tr>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($leave = $leave_res->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $leave['leave_type']; ?></td>
                <td><?php echo $leave['start_date']; ?></td>
                <td><?php echo $leave['end_date']; ?></td>
                <td><?php echo $leave['reason']; ?></td>
                <td><?php echo $leave['status']; ?></td>
                <td>
                    <form action="cancelation_of_leave.php" method="POST">
                        <input type="hidden" name="leave_id" value="<?php echo $leave['leave_id']; ?>">
                        <button type="submit" name="cancel_leave">Cancel Leave</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
<?php
?>
