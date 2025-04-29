<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../login/login_form.php");
    exit();
}
require_once '../connection/db_connect.php';

date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');

$sql = "SELECT l.leave_id, l.user_id, u.name, u.email, l.leave_type, l.start_date, l.end_date, l.reason, l.status
        FROM leave_requests l
        JOIN users u ON l.user_id = u.user_id
        WHERE l.status = 'Pending' 
        OR (l.status = 'Approved' AND l.start_date > ?)
        OR (l.status = 'Rejected' AND l.start_date > ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $current_date, $current_date);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Leaves</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f1f4f8;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #2c3e50;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 14px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #007acc;
      color: white;
    }
    tr:hover {
      background-color: #f0f8ff;
    }
    .status-pending { color: orange; font-weight: bold; }
    .status-approved { color: green; font-weight: bold; }
    .status-rejected { color: red; font-weight: bold; }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
      margin: 2px;
    }
    .approve { background-color: #28a745; }
    .reject { background-color: #dc3545; }
    .cancel { background-color: #ffc107; color: black; }

    .back-btn {
      display: block;
      margin: 30px auto;
      text-align: center;
      padding: 10px 20px;
      background-color: #007acc;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      width: 180px;
    }
    .back-btn:hover { background-color: #005f99; }
  </style>
</head>
<body>

<h1>Manage Leave Requests</h1>

<table>
  <thead>
    <tr>
      <th>Leave ID</th>
      <th>User ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Leave Type</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['leave_id'] ?></td>
        <td><?= $row['user_id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['leave_type'] ?></td>
        <td><?= $row['start_date'] ?></td>
        <td><?= $row['end_date'] ?></td>
        <td class="<?php
          $status = strtolower($row['status']);
          echo $status === 'pending' ? 'status-pending' : ($status === 'approved' ? 'status-approved' : 'status-rejected');
        ?>">
          <?= $row['status'] ?>
        </td>
        <td>
          <?php if ($status === 'pending'): ?>
            <form style="display:inline;" action="approve_leave.php" method="post">
              <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
              <button class="btn approve" type="submit">Approve</button>
            </form>
            <form style="display:inline;" action="reject_leave.php" method="post">
              <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
              <button class="btn reject" type="submit">Reject</button>
            </form>

          <?php elseif ($status === 'approved' && $row['start_date'] > $current_date): ?>
            <form style="display:inline;" action="cancel_leave.php" method="post">
              <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
              <button class="btn cancel" type="submit">Cancel</button>
            </form>

          <?php elseif ($status === 'rejected' && $row['start_date'] > $current_date): ?>
            <form style="display:inline;" action="approve_leave.php" method="post">
              <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
              <button class="btn approve" type="submit">Re-Approve</button>
            </form>

          <?php else: ?>
            N/A
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<a class="back-btn" href="../dashboard/hr_dashboard_form.php">← Back to Dashboard</a>

</body>
</html>
