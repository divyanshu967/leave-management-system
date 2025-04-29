<?php
session_start();
require_once '../connection/db_connect.php'; // Adjust the path based on your structure

if (!isset($_SESSION['name'])) {
    header("Location: ../login/login_form.php");
    exit();
}

// 1. Make sure form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['user_id'], $_POST['name'])) {
    header('Location: delete_user_form.php');
    exit();
}

// 2. Sanitize inputs
$user_id = $conn->real_escape_string(trim($_POST['user_id']));
$name    = $conn->real_escape_string(trim($_POST['name']));

// 3. Check if user exists
$check_sql = "SELECT * FROM users WHERE user_id = '$user_id' AND name = '$name'";
$check_res = $conn->query($check_sql);

if (!$check_res || $check_res->num_rows === 0) {
    echo "<p style='color: red; text-align: center; font-size: 18px;'>No user found with provided ID and Name.</p>";
    echo "<p style='text-align: center;'><a href='delete_user_form.php'>← Try Again</a></p>";
    exit();
}

// 4. Delete the user
$delete_sql = "DELETE FROM users WHERE user_id = '$user_id' AND name = '$name'";
if ($conn->query($delete_sql)) {
    echo "<p style='color: green; text-align: center; font-size: 20px; margin-top: 50px;'>✅ User '<b>$name</b>' (ID: $user_id) has been successfully deleted.</p>";
    echo "<p style='text-align: center; font-size: 16px;'><a href='../dashboard/hr_dashboard_form.php'>← Go to Dashboard</a></p>";

    // Redirect to dashboard after 3 seconds
    header("refresh:3;url=../dashboard/hr_dashboard_form.php");
} else {
    echo "<p style='color: red; text-align: center; font-size: 18px;'>Error deleting user. Please try again.</p>";
    echo "<p style='text-align: center;'><a href='delete_user_form.php'>← Try Again</a></p>";
}

$conn->close();
?>
