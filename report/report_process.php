<?php
session_start();

// Check if HR/admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'hr') {
    header('Location: ../login/login_form.php');
    exit();
}

require_once '../connection/db_connect.php';

// Get optional filters from GET (if using filters)
$filterType = $_GET['leave_type'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

// Build SQL dynamically
$sql = "
    SELECT 
        u.name AS employee_name,
        l.leave_type,
        l.start_date,
        l.end_date,
        l.status,
        DATEDIFF(l.end_date, l.start_date) + 1 AS days
    FROM leave_requests l
    JOIN users u ON u.user_id = l.user_id  -- Fixed column name here
    WHERE 1 = 1
";


if ($filterType !== '') {
    $sql .= " AND l.leave_type = '" . $conn->real_escape_string($filterType) . "'";
}
if ($startDate !== '') {
    $sql .= " AND l.start_date >= '" . $conn->real_escape_string($startDate) . "'";
}
if ($endDate !== '') {
    $sql .= " AND l.end_date <= '" . $conn->real_escape_string($endDate) . "'";
}

$sql .= " ORDER BY l.start_date DESC";

$result = $conn->query($sql);

$report_data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $report_data[] = $row;
    }
}
?>
