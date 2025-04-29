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
$check_email_sql = "SELECT * FROM users WHERE email = '$email'";
$check_email_res = $conn->query($check_email_sql);
if ($check_email_res && $check_email_res->num_rows > 0) {
    echo "<p style='color:red; text-align:center;'>Email already taken. Please enter a different email.</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
    exit();
}

// 6. Check if name already exists
$check_name_sql = "SELECT * FROM users WHERE name = '$name'";
$check_name_res = $conn->query($check_name_sql);
if ($check_name_res && $check_name_res->num_rows > 0) {
    echo "<p style='color:red; text-align:center;'>Username already taken. Please enter a different name.</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
    exit();
}

// 7. Check if password already exists
$check_pass_sql = "SELECT * FROM users WHERE password = '$password'";
$check_pass_res = $conn->query($check_pass_sql);
if ($check_pass_res && $check_pass_res->num_rows > 0) {
    echo "<p style='color:red; text-align:center;'>Password already in use. Choose a different password.</p>";
    echo "<p style='text-align:center;'><a href='add_user_form.php'>← Go Back</a></p>";
    exit();
}

// 8. Hash password (if using hashing)
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);
$hashed_password = $password;

// 9. Insert user
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
