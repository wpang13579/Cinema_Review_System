<?php
include("../controllers/userAuth.php");
require('../models/database.php');

// Fetch top-ranked movies with their average ratings
$top_ratings_query = "SELECT m.movie_id, m.movie_name AS movie_name, AVG(r.rating_score) as average_rating
                     FROM rating r
                     JOIN movie m ON r.movie_id = m.movie_id
                     GROUP BY m.movie_id
                     ORDER BY average_rating DESC";
$top_ratings_result = mysqli_query($con, $top_ratings_query)  or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Ranked Movies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .navbar-brand,
        .nav-link {
            color: #ffd700 !important;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 100px;
            color: #ffd700;
        }

        .list-group-item {
            background-color: rgba(0, 0, 0, 0.5);
            color: #ffd700;
            border: none;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .list-group-item h5 {
            color: #ffd700;
        }

        .list-group-item p {
            color: #ffd700;
        }

        .btn-secondary {
            background-color: #ffd700;
            border-color: #ffd700;
            color: black;
        }

        .btn-secondary:hover {
            background-color: #ffc107;
            border-color: #ffc107;
        }
    </style>
</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="userHome.php">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="userMovieList.php">Movie List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userTopRankView.php">Top Movie Rating</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feedbackView.php">Movie Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userProfile.php">User Profile</a>
                        </li>
                    </ul>
                    <a class="navbar-brand" href="../controllers/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h3>Top-Ranked Movies</h3>
        <?php if (mysqli_num_rows($top_ratings_result) > 0): ?>
            <div class="list-group">
                <?php while ($row = mysqli_fetch_assoc($top_ratings_result)): ?>
                    <div class="list-group-item">
                        <h5 class="mb-1">Movie Name: <span style="color: white;"><?php echo htmlspecialchars($row['movie_name']); ?></span> </h5>
                        <p class="mb-1">Average Rating:<span style="color: white;"> <?php echo number_format($row['average_rating'], 1); ?> <i class="fas fa-star"></i></span> </p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No top-ranked movies found.</p>
        <?php endif; ?>

        <div class="text-end">
            <a href="userHome.php" class="btn btn-secondary mt-4">Back</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>