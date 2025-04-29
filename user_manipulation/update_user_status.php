<?php
session_start();
require_once '../connection/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['user_id']);
    $name    = trim($_POST['name']);
    $status  = trim($_POST['status']);

    // Basic validation
    if ($user_id === '' || $name === '' || $status === '') {
        echo "<p style='color:red;text-align:center;'>All fields are required.</p>";
        exit();
    }

    // Prepare and execute update query
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ? AND name = ?");
    $stmt->bind_param("sis", $status, $user_id, $name);

    if ($stmt->execute()) {
        echo "<div style='
            margin: 100px auto;
            width: 500px;
            text-align: center;
            background-color: #f0f9ff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        '>
            <h2 style='color: #007bff;'>User status updated successfully</h2>
            <p>User ID: <strong>$user_id</strong></p>
            <p>Name: <strong>$name</strong></p>
            <p>New Status: <strong>$status</strong></p>
            <br>
            <button onclick=\"window.location.href='../dashboard/hr_dashboard_form.php'\"
                style='
                    padding: 10px 25px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                '>Go to Dashboard</button>
        </div>";
    } else {
        echo "<p style='color:red;text-align:center;'>Failed to update user status. Please try again.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: update_user_status_form.php");
    exit();
}
?>
