<?php
include('header.php');

if(!isset($_SESSION['userid']))
{
	header("location:javascript://history.go(-1)");
	exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/regstyle.css">
    <title>Photograph Upload</title>
</head>
<body class="form-v2">
<div class="container bg-white p-5 rounded no-gutters">
	<div class="page-content">
		<div class="form-v2-content">
    <form action="imageUpload.php" class="form-detail" method="POST" enctype="multipart/form-data">
            <div class="form-row">
			<label for="imagetitle">Image Title:</label>
			<input type="text" name="imagetitle" id="imagetitle" class="input-text" required>
			</div>
				<div>
					<label for="description">Description:</label>
					<textarea name="description" id="description" placeholder="A sunset photo on the beach..." rows="4" required></textarea><br><br>
				</div>
				<div class="form-row">
					<label for="image">Choose Image:</label>
					<input type="file" name="userimage" id="userimage" class="input-text" required>
				</div>
        <button type="submit" name="submit">Upload File</button>
    </form>
</div>
</div>
</div>
</body>
</html>
