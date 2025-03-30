<?php
include('header.php');
?>

<?php
include('config.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Define how many images per page
$imagesPerPage = 15;

// Get the current page number from URL, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Ensure page is at least 1

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $imagesPerPage;

// Fetch total number of images
$totalImagesQuery = "SELECT COUNT(*) AS total FROM photographs";
$totalResult = $conn->query($totalImagesQuery);
$totalImages = $totalResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalImages / $imagesPerPage);

// Fetch images with pagination
$sql = "SELECT ImageID, Image FROM photographs LIMIT $imagesPerPage OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .gallery a {
            display: inline-block;
        }
        .gallery img {
            width: 200px;
            height: auto;
            border-radius: 5px;
            transition: transform 0.2s;
        }
        .gallery img:hover {
            transform: scale(1.1);
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            margin: 5px;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Image Gallery</h2><br>
    <div class="gallery">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="imageDetails.php?imageid=' . $row["ImageID"] . '">
                        <img src="http://localhost/coursework/useruploads/' . $row["Image"] . '" alt="Image">
                      </a>';
            }
            
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
    <?php
$conn->close();
?>

</body>
</html>


