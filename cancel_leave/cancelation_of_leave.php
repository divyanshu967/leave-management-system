<?php
session_start();
require_once '../connection/db_connect.php';

// 1. Must be POST and session user_id
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'], $_POST['leave_id'])) {
    header('Location: ../leave_history/leave_history.php');
    exit();
}

$user_id  = (int) $_SESSION['user_id'];
$leave_id = $conn->real_escape_string($_POST['leave_id']);
$today    = date('Y-m-d');

// 2. Verify ownership + cancellable status
$check = "
  SELECT leave_id 
  FROM leave_requests 
  WHERE leave_id = '$leave_id'
    AND user_id  = '$user_id'
    AND end_date > '$today'
    AND status   IN ('Pending','Approved')
";
$resCheck = $conn->query($check);

if (! $resCheck || $resCheck->num_rows === 0) {
    $_SESSION['cancel_error'] = "Cannot cancel this leave.";
    header('Location: ../leave_history/leave_history.php');
    exit();
}

// 3. Perform cancellation
$sql = "
  UPDATE leave_requests
  SET status = 'Cancelled'
  WHERE leave_id = '$leave_id'
";
if ($conn->query($sql)) {
    $_SESSION['cancel_success'] = "Your leave has been cancelled.";
} else {
    $_SESSION['cancel_error'] = "Error cancelling leave: " . $conn->error;
}

// 4. Redirect back to leave history
header('Location: ../leave_history/leave_history_form.php');
exit();
