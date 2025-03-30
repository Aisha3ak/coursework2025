<?php
include 'config.php';  

session_start();

$userid = $_SESSION['userid'];  
$username = $_SESSION['username']; 
$imagetitle = $_POST['imagetitle']; 
$description = $_POST['description']; 


if (isset($_POST['submit'])) {

    if (isset($_FILES['userimage']['name']) AND !empty($_FILES['userimage']['name'])) {
         
         
        $imageName = $_FILES['userimage']['name'];
        $tmp_name = $_FILES['userimage']['tmp_name'];
        $error = $_FILES['userimage']['error'];
        
        if($error === 0){
           $img_ex = pathinfo($imageName, PATHINFO_EXTENSION);
           $img_ex_to_lc = strtolower($img_ex);

           $image = uniqid($username, true).'.'.$img_ex_to_lc;
           $img_upload_path = '../coursework/useruploads/'.$image;
           move_uploaded_file($tmp_name, $img_upload_path);

              $sql = "INSERT INTO photographs(ImageTitle, Description, Image, UserID) 
                VALUES(?,?,?,?)";
              $stmt = $conn->prepare($sql);
              $stmt->execute([$imagetitle, $description, $image, $userid]);

              header("Location: ../coursework/index.php");
               exit;
           
        }else {
            $em = "unknown error occurred!";
            header("Location: ../uploadImage.php?error=$em&$data");
            exit;
         }
   
}
}
?>
