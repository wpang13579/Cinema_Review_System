<?php
include("../controllers/userAuth.php");
require('../models/database.php');

// Ensure rating_id is present in the request
if (isset($_REQUEST['rating_id'])) {
    $rating_id = $_REQUEST['rating_id'];
} else {
    die("Rating ID is missing.");
}

$movie_id = $_SESSION['movie_id'];
// Fetch the rating details
$sel_query = "SELECT r.*, m.movie_name FROM rating r JOIN movie m ON r.movie_id = m.movie_id WHERE r.rating_id = '$rating_id'";
$result = mysqli_query($con, $sel_query) or die(mysqli_error($con));
$rating_result = mysqli_fetch_assoc($result);

if (!$rating_result) {
    die("No rating found with the given ID.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Rating Detail</title>
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
            color: black;
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

        a {
            color: #FFD700;
        }

        a:hover {
            text-decoration: underline;
        }

        h1,
        p {
            color: #FFD700;
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
            padding: 20px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 30px;  
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f2b600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>Update Rating Detail</h1>
        </div>
        <?php
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $rating_id = $_REQUEST['rating_id'];
            $user_id = $_SESSION['user_id'];
            $rating_score = $_REQUEST['rating_score'];
            $daterating = date("Y-m-d H:i:s");

            $update = "UPDATE rating SET user_id = ?, rating_score = ?, daterating = ? WHERE rating_id = ?";
            $stmt = $con->prepare($update);
            $stmt->bind_param("iisi", $user_id, $rating_score, $daterating, $rating_id);
            $stmt->execute();
            $status = "Rating updated successfully.";
            echo '<p style="color:white;">' . $status . '</p>';
        ?><a href="userMovieDetail.php?movie_id=<?php echo $movie_id; ?>">Back</a>
        <?php
        } else {
        ?>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <input type="hidden" name="rating_id" value="<?php echo htmlspecialchars($rating_id); ?>" />

                <div class="mb-3">
                    <label for="movie_name" class="form-label">Movie Name</label>
                    <input type="text" name="movie_name" class="form-control" value="<?php echo htmlspecialchars($rating_result['movie_name']); ?>" disabled />
                </div>
                <div class="mb-3 star-rating">
                    <input type="radio" id="5-stars" name="rating_score" value="5" <?php echo $rating_result['rating_score'] == 5 ? 'checked' : ''; ?> />
                    <label for="5-stars" class="star">&#9733;</label>
                    <input type="radio" id="4-stars" name="rating_score" value="4" <?php echo $rating_result['rating_score'] == 4 ? 'checked' : ''; ?> />
                    <label for="4-stars" class="star">&#9733;</label>
                    <input type="radio" id="3-stars" name="rating_score" value="3" <?php echo $rating_result['rating_score'] == 3 ? 'checked' : ''; ?> />
                    <label for="3-stars" class="star">&#9733;</label>
                    <input type="radio" id="2-stars" name="rating_score" value="2" <?php echo $rating_result['rating_score'] == 2 ? 'checked' : ''; ?> />
                    <label for="2-stars" class="star">&#9733;</label>
                    <input type="radio" id="1-star" name="rating_score" value="1" <?php echo $rating_result['rating_score'] == 1 ? 'checked' : ''; ?> />
                    <label for="1-star" class="star">&#9733;</label>
                </div>
                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
                
            </form>
            <a href="userMovieDetail.php?movie_id=<?php echo $movie_id; ?>">Back</a>
        <?php } ?>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>