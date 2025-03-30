<?php
// Set secure session parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Verify CSRF token
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || 
    $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $em = urlencode("Security validation failed. Please try again.");
    header("Location: register.php?error=$em");
    exit;
}

if(isset($_POST['username']) &&
   isset($_POST['full_name']) && 
   isset($_POST['your_email']) &&  
   isset($_POST['password'])&&  
   isset($_POST['confirm_password'])){

	require 'config.php';

	$username = $_POST["username"];
	$fullname = $_POST["full_name"];
	$email = $_POST["your_email"];
	$password = $_POST["password"];
	$confirmpassword = $_POST["confirm_password"];
	
	if (empty($fullname)) {
    	$em = urlencode("Full name is required");
    	header("Location: register.php?error=$em");
	    exit;
    }else if (empty($username)) {
    	$em = urlencode("Username is required");
    	header("Location: register.php?error=$em");
	    exit;
    }else if(empty($email)){
    	$em = urlencode("Email is required");
    	header("Location: register.php?error=$em");
	    exit;
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    	$em = urlencode("Invalid email format");
    	header("Location: register.php?error=$em");
	    exit;
    }else if(empty($password)){
    	$em = urlencode("Password is required");
    	header("Location: register.php?error=$em");
	    exit;
	}else if(empty($confirmpassword)){
		$em = urlencode("Confirm Password is required");
		header("Location: register.php?error=$em");
		exit;
    }else if ($password !== $confirmpassword) {
		$em = urlencode("Passwords do not match");
		header("Location: register.php?error=$em");
		exit;
	}
	else{
		// Hash the password securely using bcrypt
		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		if (isset($_FILES['profilepic']['name']) AND !empty($_FILES['profilepic']['name'])) {
         
			// Define allowed file types and maximum file size
			$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
			$max_file_size = 2 * 1024 * 1024; // 2MB
         
			$img_name = $_FILES['profilepic']['name'];
			$tmp_name = $_FILES['profilepic']['tmp_name'];
			$error = $_FILES['profilepic']['error'];
			$size = $_FILES['profilepic']['size'];
			
			if($error === 0){
				// Check file size
				if ($size > $max_file_size) {
					$em = urlencode("File too large (max 2MB)");
					header("Location: register.php?error=$em");
					exit;
				}

				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_to_lc = strtolower($img_ex);
   
				// Validate file extension
				if (!in_array($img_ex_to_lc, $allowed_extensions)) {
					$em = urlencode("Invalid file type. Only JPG, JPEG, PNG and GIF allowed");
					header("Location: register.php?error=$em");
					exit;
				}

				// Check MIME type using finfo
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				$mime_type = $finfo->file($tmp_name);
				$allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
				
				if (!in_array($mime_type, $allowed_mime_types)) {
					$em = urlencode("Invalid file content detected");
					header("Location: register.php?error=$em");
					exit;
				}

				// Sanitize username before using in filepath
				$safe_username = preg_replace('/[^a-zA-Z0-9_]/', '', $username);
				$profilepic = uniqid($safe_username, true).'.'.$img_ex_to_lc;
				
				// Construct the complete path
				$upload_dir = realpath('profilepicuploads/');
				$img_upload_path = $upload_dir . DIRECTORY_SEPARATOR . $profilepic;
				
				// Verify the path is within the allowed directory
				if (strpos(realpath(dirname($img_upload_path)), $upload_dir) !== 0) {
					$em = urlencode("Invalid file path");
					header("Location: register.php?error=$em");
					exit;
				}
   
				// Actually move the file
				if (!move_uploaded_file($tmp_name, $img_upload_path)) {
					$em = urlencode("Failed to save the uploaded file");
					header("Location: register.php?error=$em");
					exit;
				}
   
				// Insert into Database
				$sql = "INSERT INTO users(UserName, FullName, Email, ProfilePic, Password) VALUES(?,?,?,?,?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("sssss", $username, $fullname, $email, $profilepic, $hashed_password);
				
				if($stmt->execute()) {
					$em = urlencode("Registration successful! Please login.");
					header("Location: login.php?success=$em");
					exit();
				} else {
					$em = urlencode("Registration failed: " . $stmt->error);
					header("Location: register.php?error=$em");
					exit();
				}
			   
			}else {
				$em = urlencode("Unknown error occurred during file upload");
				header("Location: register.php?error=$em");
				exit;
			}
		}else {
			$sql = "INSERT INTO users(UserName, FullName, Email, Password) VALUES(?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssss", $username, $fullname, $email, $hashed_password);
			
			if($stmt->execute()) {
				$em = urlencode("Registration successful! Please login.");
				header("Location: login.php?success=$em");
				exit();
			} else {
				$em = urlencode("Registration failed: " . $stmt->error);
				header("Location: register.php?error=$em");
				exit();
			}
		}
	}
}
?>