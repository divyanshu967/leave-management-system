<?php
session_start();
require_once '../connection/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leave_id = $conn->real_escape_string($_POST['leave_id']);
    $leave_type = $conn->real_escape_string($_POST['leave_type']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $reason = $conn->real_escape_string($_POST['reason']);

    $sql = "UPDATE leave_requests 
            SET leave_type = '$leave_type', start_date = '$start_date', end_date = '$end_date', reason = '$reason', status = 'Pending'
            WHERE leave_id = '$leave_id'";

    if ($conn->query($sql)) {
        header('Location: ../leave_history/leave_history_form.php');
        exit();
    } else {
        echo "Error updating leave request: " . $conn->error;
    }
}
?>
