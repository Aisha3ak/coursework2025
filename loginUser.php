<?php
// Set secure session parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();
require 'config.php';

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$username || !$password) {
    $em = urlencode("Please provide all required login information");
    header("Location: login.php?error=$em");
    exit;
}

// Get user data by username only, we'll verify password separately
$stmt = $conn->prepare("SELECT UserID, UserName, FullName, Email, ProfilePic, Password FROM users WHERE UserName = ?");

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result(); 

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify the provided password against the stored hash
    if (password_verify($password, $row['Password'])) {
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        // Password is correct, set session variables
        $_SESSION['userid'] = $row['UserID'];
        $_SESSION['username'] = $row['UserName'];
        $_SESSION['email'] = $row['Email'];
        $_SESSION['fullname'] = $row['FullName'];
        $_SESSION['profilepic'] = $row['ProfilePic'];
        
        // Set a CSRF token for form protection
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        header("Location: index.php");
        exit();
    } else {
        // Password is incorrect
        $em = urlencode("Invalid username or password");
        header("Location: login.php?error=$em");
        exit;
    }
} else {
    // Username not found - use a generic message to prevent username enumeration
    $em = urlencode("Invalid username or password");
    header("Location: login.php?error=$em");
    exit;
}
?>
