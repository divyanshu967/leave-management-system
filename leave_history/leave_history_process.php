<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login_form.php');
    exit();
}

// Database connection
require_once '../connection/db_connect.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Query to get the leave request history for the logged-in user
$sql = "
    SELECT leave_type, start_date, end_date, reason, status
    FROM leave_requests
    WHERE user_id = $user_id
    ORDER BY start_date DESC
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $leave_history = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $leave_history = [];
}

?>
