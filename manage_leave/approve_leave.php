<?php
require_once '../connection/db_connect.php';

if (isset($_POST['leave_id'])) {
    $leave_id = intval($_POST['leave_id']);
    $sql = "UPDATE leave_requests SET status = 'approved' WHERE leave_id = $leave_id";

    if ($conn->query($sql)) {
        echo "<p style='color: green; text-align: center;'>Leave approved successfully.</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red; text-align: center;'>Invalid leave ID.</p>";
}

echo "<p style='text-align: center;'><a href='../dashboard/hr_dashboard_form.php'>Return to Dashboard</a></p>";
?>
