<?php include('view_history_process.php'); // This includes the backend logic you just shared ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
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
            margin-top: 15px;
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

<h1>Leave History</h1>

<?php if (!empty($leave_history)): ?>
    <table>
        <thead>
            <tr>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leave_history as $leave): ?>
                <tr>
                    <td><?= htmlspecialchars($leave['leave_type']) ?></td>
                    <td><?= htmlspecialchars($leave['start_date']) ?></td>
                    <td><?= htmlspecialchars($leave['end_date']) ?></td>
                    <td><?= htmlspecialchars($leave['reason']) ?></td>
                    <td><?= htmlspecialchars($leave['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align: center; font-size: 16px; color: #555;">
        You have not submitted any leave requests yet.
    </p>
<?php endif; ?>

<div class="back-link">
    <a href="../dashboard/hr_dashboard_form.php">← Back to Dashboard</a>
</div>

</body>
</html>
