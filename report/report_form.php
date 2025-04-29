<?php include('report_process.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leave Reports</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
    h1 { text-align: center; }
    .filter-form, .export-buttons, table { max-width: 1000px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; }
    .filter-form input, .filter-form select, .filter-form button {
      padding: 8px; margin: 5px; border-radius: 4px; border: 1px solid #ccc;
    }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #007acc; color: white; }
    .export-buttons button {
      margin-right: 10px; background: #007acc; color: white; border: none; padding: 10px 15px; border-radius: 5px;
    }
  </style>
</head>
<body>

<h1>Leave Reports</h1>

<form method="GET" class="filter-form">
  <label>Leave Type:</label>
  <select name="leave_type">
    <option value="">All</option>
    <option value="CL">Casual</option>
    <option value="SL">Sick</option>
    <option value="PL">Privilege</option>
  </select>

  <label>Start Date:</label>
  <input type="date" name="start_date">

  <label>End Date:</label>
  <input type="date" name="end_date">

  <button type="submit">Generate Report</button>
</form>

<div class="export-buttons">
  <form method="POST" action="export_csv.php" style="display:inline;">
    <button type="submit" name="export_csv">Export as CSV</button>
  </form>
  <form method="POST" action="export_pdf.php" style="display:inline;">
    <button type="submit" name="export_pdf">Export as PDF</button>
  </form>
</div>

<?php if (count($report_data) > 0): ?>
  <table>
    <thead>
      <tr>
        <th>Employee</th>
        <th>Leave Type</th>
        <th>Start</th>
        <th>End</th>
        <th>Status</th>
        <th>Days</th>
        <th>Leave Balance</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($report_data as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['employee_name']) ?></td>
          <td><?= htmlspecialchars($row['leave_type']) ?></td>
          <td><?= htmlspecialchars($row['start_date']) ?></td>
          <td><?= htmlspecialchars($row['end_date']) ?></td>
          <td><?= htmlspecialchars($row['status']) ?></td>
          <td><?= $row['days'] ?></td>
          <td><?= $row['leave_balance'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p style="text-align:center;">No leave records found.</p>
<?php endif; ?>

</body>
</html>
