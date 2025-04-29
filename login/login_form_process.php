<?php
session_start(); // Start the session

// Include the database connection file
require_once '../connection/db_connect.php';


// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted name and password
    $name = $_POST['name']; 
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $name = $conn->real_escape_string($name);
    $password = $conn->real_escape_string($password);

    // Query to check if a user with the provided name exists
    $sql = "SELECT * FROM users WHERE name = '$name' LIMIT 1";
    $result = $conn->query($sql);

    // If a user is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the password matches the stored password
        if ($password == $user['password']) {
            // Store user data in session to identify them across pages
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on the role of the user
            if ($user['status'] == 'active') {
                // Redirect user to the appropriate dashboard
                if ($user['role'] == 'employee') {
                    header('Location: ../dashboard/employee_dashboard_form.php'); // For employee role
                } elseif ($user['role'] == 'hr') {
                    header('Location: ../dashboard/hr_dashboard_form.php'); // For HR role
                }
                exit();
            } else {
                // Inactive account message
                $error_message = "Your account is inactive.";
            }
        } else {
            // Invalid password
            $error_message = "Incorrect password.";
        }
    } else {
        // User not found
        $error_message = "User not found.";
    }
}
if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>

