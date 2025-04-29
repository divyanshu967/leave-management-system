<?php
// Start session (optional here unless needed for admin login)
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: ../login/login_form.php');
    exit();
}

// Ensure the form submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method.";
    exit();
}

// Check if required fields are present
if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    echo "User ID is required.";
    exit();
}

// Get user ID and name from POST
$userId = (int)$_POST['user_id'];
$userName = trim($_POST['user_name'] ?? '');

// Connect to database
require_once '../connection/db_connect.php';

// Fetch leave history for given user ID
$sql = "
    SELECT 
        leave_type, 
        start_date, 
        end_date, 
        reason, 
        status
    FROM leave_requests
    WHERE user_id = $userId
    ORDER BY start_date DESC
";

$result = $conn->query($sql);
$leave_history = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leave_history[] = $row;
    }
}
?>
