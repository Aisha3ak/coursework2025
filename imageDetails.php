<?php
include('header.php');
include 'config.php';

if(isset($_SESSION['fullname'])){
    $fullname = $_SESSION['fullname'];
}

$imageid = isset($_GET['imageid']) ? intval($_GET['imageid']) : 0;


$sql = "SELECT * FROM Photographs WHERE ImageID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $imageid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $imageid = $data['ImageID'];
    $title = $data['ImageTitle'];
    $description = $data['Description'];
    $image = $data['Image'];
    $userID = $data['UserID'];
    $img_path = 'http://localhost/coursework/useruploads/'.$image;
} else {
    echo "<h1>Data Not Found</h1>";
    exit;
}

?>


<div class="col-lg-8">
    <div class="image-container mb-3">
        <img src="<?php echo $img_path; ?>" class="img-fluid rounded shadow" alt="Image">
    </div>
</div>
<div class="col-lg-8">
    <div class="form-v2-content p-3 border rounded shadow-sm bg-light">
        <form class="form-detail">
            <div class="form-group">
                <label for="imagetitle" class="font-weight-bold">Image Title:</label>
                <input type="text" name="imagetitle" id="imagetitle" class="form-control" value="<?php echo $title ?>" disabled>
            </div>
            <div class="form-group">
                <label for="description" class="font-weight-bold">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" disabled><?php echo $description ?></textarea>
            </div>
        </form>
    </div>
</div>



<?php

// Prepare SQL query to get comments for a specific ImageID
$sql = "SELECT * FROM comments WHERE ImageID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $imageid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $comment = [];
    while ($row = $result->fetch_assoc()) {
        $comment[] = $row;
    }


    if (!empty($comment)) { ?>
        
        <section style="background-color:rgb(175, 202, 229);">
        <div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
              <div class="card text-dark">
                <div class="card-body p-4">
                  <h4 class="mb-0">Recent comments</h4>
                  <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>
                  <?php 
                  foreach ($comment as $row) { ?>
                      <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong me-3"
                          src="http://localhost/coursework/profilepicuploads/<?php echo htmlspecialchars($row['ProfilePic']); ?>" alt="img" width="60" height="60" />
                        <div class="px-2">
                          <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($row['Fullname']); ?></h6>
                          <p class="mb-0"><?php echo htmlspecialchars($row['Comment']); ?></p>
                        </div>
                      </div>
                      <br>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


<?php

        } } else { ?>

  <section style="background-color:rgb(175, 202, 229);">
        <div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
              <div class="card text-dark">
                <div class="card-body p-4">
                  <h4 class="mb-0">Recent comments</h4>
                  <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>
                      <div class="d-flex flex-start">
                        <div class="px-2">
                          <p class="mb-0"><?php echo "No Comments Yet."; ?> </p>
                        </div>
                      </div>
                      <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php
  
}
if(isset($_SESSION['username'])) 
{ ?>
<section style="background-color:rgb(175, 202, 229);">
<div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
              <div class="card text-dark">
                <div class="card-body p-4">
                  <h4 class="mb-0">Comment Here!</h4>
                  <p class="fw-light mb-4 pb-2">Let them know what you think!</p>
<form method="POST" action="comments.php">
    <h6>Commenting as:</h6>
    <div class="px-2">
    <input id="fullname" name="fullname" value="<?php echo $fullname; ?>" disabled><br>
    <label for="comment">Comment:</label><br>
    <textarea id="comment" name="comment"></textarea><br><br>
    <input id="imageid" name="imageid" value="<?php echo $_GET['imageid']; ?>" hidden><br>
    <input id="profilepic" name="profilepic" value="<?php if(isset($_SESSION['profilepic'])){echo $_SESSION['profilepic'];} else { echo "EmptyProfilePicture.jpg";} ?>" hidden><br>
    <button type="submit" name="submit">Submit</button>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</section>
<?php }
?>
