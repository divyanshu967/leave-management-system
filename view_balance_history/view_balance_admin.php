<?php
session_start();

// 1. Check if admin is logged in (you can modify based on your session variable)
if (!isset($_SESSION['name'])) {
    header('Location: ../login/login_form.php');
    exit();
}

// 2. Connect to the database
require_once '../connection/db_connect.php';

// 3. Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
    $userName = trim($_POST['user_name'] ?? '');

    // 4. Define annual entitlements
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

    // 5. Get current date
    date_default_timezone_set('Asia/Kolkata');
    $currentDate = date('Y-m-d');

    // 6. Query used leave days (only approved and already completed)
    $sql = "
        SELECT 
            leave_type,
            SUM(DATEDIFF(end_date, start_date) + 1) AS used_days
        FROM leave_requests
        WHERE user_id = ?
          AND status = 'Approved'
          AND end_date < ?
        GROUP BY leave_type
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $currentDate);
    $stmt->execute();
    $result = $stmt->get_result();

    $used = [];
    while ($row = $result->fetch_assoc()) {
        $used[$row['leave_type']] = (int)$row['used_days'];
    }
} else {
    // Redirect if someone tries to access without form submission
    header("Location: check_user_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leave Balance - Admin View</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f7f8;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    h2 {
      text-align: center;
      color: #555;
    }
    table {
      width: 100%;
      max-width: 700px;
      margin: 20px auto;
      background: #fff;
      border-collapse: collapse;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #007acc;
      color: white;
    }
    tr:last-child td {
      border-bottom: none;
    }
    .back {
      text-align: center;
      margin-top: 30px;
    }
    .back a {
      padding: 10px 20px;
      background: #007acc;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    .back a:hover {
      background: #005b9f;
    }
  </style>
</head>
<body>

<h1>Leave Balance Summary</h1>
<h2>Employee: <?= htmlspecialchars($userName) ?> (ID: <?= $userId ?>)</h2>

<table>
  <thead>
    <tr>
      <th>Leave Type</th>
      <th>Entitlement</th>
      <th>Used</th>
      <th>Remaining</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($entitlements as $type => $total): 
        $usedDays = $used[$type] ?? 0;
        $remaining = $total - $usedDays;
    ?>
      <tr>
        <td><?= htmlspecialchars($type) ?></td>
        <td><?= $total ?></td>
        <td><?= $usedDays ?></td>
        <td><?= max(0, $remaining) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="back">
  <a href="view_balance_history_form.php">← Back</a>
</div>

</body>
</html>
