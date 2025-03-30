<?php
// Set secure session parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Generate CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_SESSION['userid']))
{
	header("location:javascript://history.go(-1)");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register Here</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/regstyle.css"/>
</head>
<body class="form-v2">
	<div class="page-content">
		<div class="form-v2-content">
			<div class="form-left">
				<img src="images/reg-pic.jpg" alt="form" width="500">
			</div>
			<form class="form-detail" action="registerUser.php" onSubmit="return checkValidations(event)" method="POST" id="registrationform" enctype="multipart/form-data">
				<h2>Registration Form</h2>
				<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?>
			</div>
		    <?php } ?>
				<!-- CSRF Protection -->
				<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
			   <div class="form-row">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" class="input-text" required>
				</div>
				<div class="form-row">
					<label for="full_name">Full Name:</label>
					<input type="text" name="full_name" id="full_name" class="input-text" placeholder="ex: Lindsey Wilson" required>
				</div>
				<div class="form-row">
					<label for="your_email">Your Email:</label>
					<input type="text" name="your_email" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				<div class="form-row">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="input-text" required>
				</div>
				<div class="form-row">
					<label for="confirm_password">Confirm Password:</label>
					<input type="password" name="confirm_password" id="confirm_password" class="input-text" required>
				</div>
				<div class="form-row">
                            <div class="form-row">Upload Profile Picture</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="profilepic" id="profilepic">
                                </div>
				<div class="form-row">
					<button type="submit" name="register" class="register">Register</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>