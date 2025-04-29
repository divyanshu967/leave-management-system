<?php
session_start();

// 1. Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login_form.php');
    exit();
}

// 2. Database connection
require_once '../connection/db_connect.php';

// 3. Define annual entitlements
$entitlements = [
    'Privilege Leave (PL) or Earned Leave (EL)'     => 24,
    'Casual Leave (CL)'                             => 12,
    'Sick Leave (SL)'                               => 10,
    'Maternity Leave (ML)'                          => 90,
    'Compensatory Off (Comp-off)'                   => 0,
    'Marriage Leave'                                => 5,
    'Paternity Leave'                               => 7,
    'Bereavement Leave'                             => 5,
    'Loss of Pay (LOP) / Leave Without Pay (LWP)'   => 0,
];

// 4. Fetch how many days of each type have been approved and completed
$userId = (int)$_SESSION['user_id'];
$currentDate = date('Y-m-d'); // Get current date

$sql = "
    SELECT 
      leave_type,
      SUM(DATEDIFF(end_date, start_date) + 1) AS used_days
    FROM leave_requests
    WHERE user_id = $userId
      AND status = 'Approved'
      AND end_date < '$currentDate'
    GROUP BY leave_type
";
$result = $conn->query($sql);

// 5. Build an associative array of used days
$used = [];
while ($row = $result->fetch_assoc()) {
    $used[$row['leave_type']] = (int)$row['used_days'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Leave Balance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f7f8;
      margin: 0; padding: 20px;
    }
    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      max-width: 600px;
      margin: 0 auto 40px;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
    }
    th {
      background: #007acc;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: .05em;
    }
    tr:last-child td {
      border-bottom: none;
    }
    .back-link {
      text-align: center;
    }
    .back-link a {
      display: inline-block;
      margin-top: 10px;
      color: #007acc;
      text-decoration: none;
      font-weight: bold;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h1>Your Leave Balances</h1>

  <table>
    <tr>
      <th>Leave Type</th>
      <th>Entitlement</th>
      <th>Used</th>
      <th>Remaining</th>
    </tr>
    <?php foreach ($entitlements as $type => $total): 
        $usedDays  = $used[$type] ?? 0;
        $remaining = $total - $usedDays;
    ?>
    <tr>
      <td><?= htmlspecialchars($type) ?></td>
      <td><?= $total ?></td>
      <td><?= $usedDays ?></td>
      <td><?= $remaining ?></td>
    </tr>
    <?php endforeach; ?>
  </table>

  <div class="back-link">
    <a href="../dashboard/employee_dashboard_form.php">← Back to Dashboard</a>
  </div>

</body>
</html>
