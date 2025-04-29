<?php
session_start();
require_once '../connection/db_connect.php';

// 1. Ensure request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_user_form.php');
    exit();
}

// 2. Sanitize inputs
$name              = trim($conn->real_escape_string($_POST['name']));
$email             = trim($conn->real_escape_string($_POST['email']));
$password          = trim($_POST['password']);
$confirm_password  = trim($_POST['confirm_password']);
$role              = trim($conn->real_escape_string($_POST['role']));
$status            = trim($conn->real_escape_string($_POST['status']));

// 3. Check for required fields
if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role) || empty($status)) {
    echo "<p style='color:red; text-align:center;'>All fields are required.</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
    exit();
}

// 4. Check if passwords match
if ($password !== $confirm_password) {
    echo "<p style='color:red; text-align:center;'>Passwords do not match.</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
    exit();
}

// 5. Check if email already exists
$check_sql = "SELECT * FROM users WHERE email = '$email'";
$check_res = $conn->query($check_sql);
if ($check_res && $check_res->num_rows > 0) {
    echo "<p style='color:red; text-align:center;'>User with this email already exists.</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
    exit();
}

// 6. Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 7. Insert user
$insert_sql = "
    INSERT INTO users (name, email, password, role, status)
    VALUES ('$name', '$email', '$hashed_password', '$role', '$status')
";

if ($conn->query($insert_sql) === TRUE) {
    echo "<p style='color:green; text-align:center;'>User added successfully.</p>";
    echo "<p style='text-align:center;'><a href='add_deleteuser.php'>← Back to User Management</a></p>";
} else {
    echo "<p style='color:red; text-align:center;'>Error adding user: " . $conn->error . "</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
}

$conn->close();
?>
