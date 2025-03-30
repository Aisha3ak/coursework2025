
<?php
include('header.php');

include 'config.php';  




if ($conn->connect_error) {
    die("Connection failed!: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $userid = $_SESSION['userid']; 
    $fullname = $_SESSION['fullname'];
    $comment = $_POST['comment']; 
    $imageid = $_POST['imageid'];
    $profilepic = $_POST['profilepic'];

    
    $stmt = $conn->prepare("INSERT INTO Comments (Fullname, ProfilePic, UserID, Comment, ImageID) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    
    $stmt->bind_param("ssisi", $fullname, $profilepic, $userid, $comment, $imageid);

    if ($stmt->execute()) {
        echo "Comment submitted successfully!";
    ?>
    <div> <?php
     echo '<a href="imageDetails.php?imageid=' . $imageid . '">Go Back</a>';
     ?>
</div>
    <?php
    } else {
        echo "Error: " . $stmt->error;
    }
}

 


?>


