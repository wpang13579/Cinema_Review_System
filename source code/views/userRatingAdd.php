<?php
include("../controllers/userAuth.php");
require('../models/database.php');

$status = "";

// Fetch movie names from the database
$movie_id = $_SESSION['movie_id'];
$movie_query = "SELECT movie_name FROM movie WHERE movie_id = '$movie_id'";
$movie_result = mysqli_query($con, $movie_query) or die(mysqli_error($con));
$movie = mysqli_fetch_assoc($movie_result);

if (isset($_POST['new']) && $_POST['new'] == 1) {
    // Check if user has already rated this movie
    $user_id = $_SESSION['user_id'];
    $check_query = "SELECT * FROM rating WHERE user_id = '$user_id' AND movie_id = '$movie_id'";
    $check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));

    if (mysqli_num_rows($check_result) > 0) {
        $status = "You have already rated this movie.";
    } else {
        // User hasn't rated the movie, proceed to insert the new rating
        $rating_score = $_POST['rating_score'];
        $daterating = date("Y-m-d H:i:s");

        $ins_query = "INSERT INTO rating(`user_id`, `movie_id`, `rating_score`, `daterating`) VALUES ('$user_id', '$movie_id', '$rating_score', '$daterating')";
        mysqli_query($con, $ins_query) or die(mysqli_error($con));
        $status = "New Rating Entered Successfully";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate a Movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #1e2a38;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #0b1720;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            font-size: 2rem;
            color: #ffd700;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #ffd700;
        }

        .form-control {
            background-color: #0d1117;
            border: 2px solid #30363d;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #0062cc;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            margin-top: 20px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #3c4a55;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            margin-top: 10px;
            width: 100%;
            text-align: center;
            color: white;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #2c363f;
        }

        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 2rem;
            padding: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f2b600;
        }

        p {
            font-size: 1rem;
            text-align: center;
            margin-top: 20px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 1rem;
            color: #ffd700;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Rate a Movie</h2>

        <form method="post" action="">
            <input type="hidden" name="new" value="1" />
            <div class="mb-3">
                <label for="movie_name" class="form-label">Movie Name</label>
                <input type="text" class="form-control" id="movie_name" name="movie_name" value="<?php echo htmlspecialchars($movie['movie_name']); ?>" readonly>
            </div>

            <div class="mb-3 star-rating">
                <input type="radio" id="5-stars" name="rating_score" value="5" />
                <label for="5-stars" class="star">&#9733;</label>
                <input type="radio" id="4-stars" name="rating_score" value="4" />
                <label for="4-stars" class="star">&#9733;</label>
                <input type="radio" id="3-stars" name="rating_score" value="3" />
                <label for="3-stars" class="star">&#9733;</label>
                <input type="radio" id="2-stars" name="rating_score" value="2" />
                <label for="2-stars" class="star">&#9733;</label>
                <input type="radio" id="1-star" name="rating_score" value="1" />
                <label for="1-star" class="star">&#9733;</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit Rating</button>
            <a href="userMovieDetail.php?movie_id=<?php echo $movie_id; ?>" class="btn btn-secondary">Back to Movie Details</a>
        </form>

        <p><?php echo $status; ?></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@docsearch/js@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>
