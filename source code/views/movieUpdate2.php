<?php
include("../controllers/adminAuth.php");
require('../models/database.php');

$movie_id = $_GET['movie_id'];
$status = "";

// Fetch current movie details
$query = "SELECT * FROM movie WHERE movie_id='$movie_id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update']) && $_POST['update'] == 1) {
    $movie_name = $_REQUEST['movie_name'];
    $genre = $_REQUEST['genre'];
    $release_date = $_REQUEST['release_date'];
    $description = $_REQUEST['description'];

    // Handle file upload
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $target_dir = "../controllers/uploads/";
        $unique_name = uniqid() . '-' . basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . $unique_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $status = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists (This check becomes redundant with unique naming, but keeping it for safety)
        if (file_exists($target_file)) {
            $status = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (Adjust the size limit as needed; here it's set to ~2MB)
        if ($_FILES["profile_picture"]["size"] > 2000000) {
            $status = "Sorry, your file is too large. Maximum allowed size is 2MB.";
            $uploadOk = 0;
        }

        // Allow only JPG and JPEG file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            $status = "Sorry, only JPG and JPEG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $status = "Sorry, your file was not uploaded. " . $status;
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // Store the relative path to the uploaded image
                $profile_picture = $target_file;
                $update_query = "UPDATE movie SET movie_name='$movie_name', genre='$genre', release_date='$release_date', description='$description', profile_picture='$profile_picture' WHERE movie_id='$movie_id'";
            } else {
                $status = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $update_query = "UPDATE movie SET movie_name='$movie_name', genre='$genre', release_date='$release_date', description='$description' WHERE movie_id='$movie_id'";
    }

    if (mysqli_query($con, $update_query)) {
        $status = "Movie Updated Successfully.<br><br><a href='movieView.php'>View Movie Record</a>";
    } else {
        $status = "Database Update Failed: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Movie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .form-control {
            background: none;
            border: 2px solid white;
            border-radius: 0;
            color: white;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #FFD700;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #FFD700;
            border-color: #FFD700;
        }

        .btn-primary:hover {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        h1,
        p {
            color: #FFD700;
        }

        a {
            color: #FFD700;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .back-button a {
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .back-button a:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center my-5">
            <h1>Update Movie</h1>
        </div>

        <form name="form" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="update" value="1" />
            <div class="mb-3">
                <input type="text" name="movie_name" class="form-control" value="<?php echo $row['movie_name']; ?>" placeholder="Enter Movie Name" required />
            </div>
            <div class="mb-3">
                <input type="text" name="genre" class="form-control" value="<?php echo $row['genre']; ?>" placeholder="Enter Movie Genre" required />
            </div>
            <div class="mb-3">
                <input type="datetime-local" name="release_date" class="form-control" value="<?php echo $row['release_date']; ?>" placeholder="Enter Movie Release Date" required />
            </div>
            <div class="mb-3">
                <input type="text" name="description" class="form-control" value="<?php echo $row['description']; ?>" placeholder="Enter Movie Description" required />
            </div>
            <div class="mb-3">
                <label>Current Profile Picture:</label><br>
                <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" width="100"><br>
                <input type="file" name="profile_picture" class="form-control" accept=".jpg, .jpeg" />
                <small class="form-text text-muted">Only .jpg and .jpeg files are allowed. Maximum size: 2MB.</small>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <p class="mt-3"><?php echo $status; ?></p>
    </div>
    <div class="back-button">
        <a href="movieDetail.php" class="btn btn-secondary">Back</a>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>