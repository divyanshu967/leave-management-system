<?php
// db_connect.php

// 1. Database credentials
$DB_HOST = 'localhost';     // Your MySQL server (usually 'localhost' for local server)
$DB_USER = 'root';          // Your MySQL username (default is 'root' for XAMPP)
$DB_PASS = '';              // Your MySQL password (default is empty for XAMPP)
$DB_NAME = 'leave_management_system';            // Name of the database you're connecting to
$DB_CHARSET = 'utf8mb4';    // Character set to use for the connection (supports all Unicode characters)

// 2. Create a new MySQLi connection object
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// 3. Check for connection errors
if ($conn->connect_error) {
    // If connection fails, stop execution and display the error
    die('Database connection failed: ' . $conn->connect_error);
}

// 4. Set the character set to utf8mb4 (for full Unicode support)
if (! $conn->set_charset($DB_CHARSET)) {
    // If setting charset fails, stop execution and display the error
    die('Error loading character set '. $DB_CHARSET .': ' . $conn->error);
}

// Connection is successful and charset is set
// You can now use $conn to interact with your database

?>
