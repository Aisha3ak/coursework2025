<?php
// Retrieve configuration from environment variables if available, otherwise use defaults
$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_user = getenv('DB_USER') ?: 'root'; // Should be changed to a dedicated database user in production
$db_pass = getenv('DB_PASS') ?: 'lab123'; // Should be a strong, unique password in production
$db_name = getenv('DB_NAME') ?: 'coursework';

// Establish connection with error handling
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    // Log the error securely (not to browser)
    error_log("Database connection failed: " . mysqli_connect_error());
    
    // Display a generic error message
    die("Database connection error. Please try again later or contact support.");
}

// Set charset to ensure proper encoding
mysqli_set_charset($conn, 'utf8mb4');
?>