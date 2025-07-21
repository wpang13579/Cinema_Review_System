<?php
include("../controllers/userAuth.php");
require('../models/database.php');

if (isset($_REQUEST['movie_id'])) {
    $movie_id = $_REQUEST['movie_id'];
} else {
    echo "Movie ID is missing.";
    exit;
}

$_SESSION['movie_id'] = $movie_id;
// movie details
$query = "SELECT * FROM movie WHERE movie_id='" . $movie_id . "'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

// feedback
$current_user_id = $_SESSION['user_id'];

// rating
$ratingStatus = "";

$check_query = "SELECT * FROM rating WHERE user_id ='$current_user_id' AND movie_id = '$movie_id'";
$check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));

if (mysqli_num_rows($check_result) > 0) {
    // User has already rated this movie
    $ratingStatus = "You have already rated this movie.";
}

// fetch movie rating average
$avg_rating_query = "SELECT AVG(rating_score) as average_rating FROM rating WHERE movie_id='" . $movie_id . "'";
$avg_rating_result = mysqli_query($con, $avg_rating_query) or die(mysqli_error($con));
$avg_rating_row = mysqli_fetch_assoc($avg_rating_result);
$average_rating = round($avg_rating_row['average_rating'], 1);

//fetch user rating
$reviews_query = "SELECT r.rating_score, r.daterating, u.username
                    FROM rating r
                    JOIN user_details u ON r.user_id = u.user_id
                    WHERE r.movie_id='$movie_id'
                    ORDER BY r.daterating DESC";
$reviews_result = mysqli_query($con, $reviews_query) or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Movie Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        main {
            padding-top: 60px;
            width: 100%;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
        }

        table {
            width: 100%;
            color: white;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #555;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        .navbar-brand,
        .nav-link {
            color: #ffd700 !important;
        }

        a {
            color: #ffd700;
        }

        a:hover {
            text-decoration: underline;
        }

        footer a {
            color: #ffd700;
        }

        footer a:hover {
            text-decoration: underline;
        }

        h1,
        p {
            color: #ffd700;
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

    <!-- Main content -->
    <main class="container">
        <!-- movie  -->
        <div class="text-center my-5">
            <h1>Movie Detail</h1>
        </div>

        <div class="text-center">
            <img src="../controllers/<?php echo $row["profile_picture"]; ?>" alt="Profile Picture" style="max-width: 200px; height: auto; border-radius: 15px;">
        </div>

        <div class="table-responsive my-5">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Movie Name</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row["movie_name"]; ?></td>
                        <td><?php echo $row["genre"]; ?></td>
                        <td><?php echo $row["release_date"]; ?></td>
                        <td><?php echo $row["description"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- rating -->
        <div class="rating-container text-center">
            <div class="average-rating">
                Average Rating: <?php echo $average_rating; ?> &#9733;
            </div>
            <div class="button-group">
                <a href="../views/userRatingAdd.php?movie_id=<?php echo htmlspecialchars($row["movie_id"]); ?>" class="btn btn-primary me-3">Add Rating</a>
                <a href="../views/userRatingUp.php?movie_id=<?php echo htmlspecialchars($row["movie_id"]); ?>" class=" btn btn-success">Update/Delete Rating</a>
            </div>
        </div>

        <div class="container mt-5" style="background-color: #1c1c1c; padding: 20px; border-radius: 10px;">
    <div class="mt-5">
        <h3 style="color: #ffffff;">User Reviews for "<?php echo htmlspecialchars($row['movie_name']); ?>"</h3>
        <?php if (mysqli_num_rows($reviews_result) > 0): ?>
            <div class="list-group">
                <?php while ($review = mysqli_fetch_assoc($reviews_result)): ?>
                    <div class="list-group-item" style="background-color: #333333; color: #ffffff; border: none; margin-bottom: 10px;">
                        <div>
                            <div class="username" style="font-weight: bold; color: #FFD700;"><?php echo htmlspecialchars($review['username']); ?></div>
                            <div><?php echo str_repeat('&#9733;', $review['rating_score']); ?></div>
                            <div class="daterating">Date Rating: <?php echo htmlspecialchars($review['daterating']); ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="color: #ffffff;">No user reviews found for this movie.</p>
        <?php endif; ?>
    </div>
</div>


        <!-- feedback -->
        <div class="row">
            <div class="col">
                <h2>Feedback</h2>
            </div>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Movie Name</th>
                        <th>User Name</th>
                        <th>Comment</th>
                        <th>Time Post</th>
                        <th>Delete/Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $sel_query = "SELECT feedback.feedback_id,user_details.user_id, movie.movie_name, feedback.comment, user_details.username, feedback.dateposed 
                                  FROM movie, feedback, user_details 
                                  WHERE movie.movie_id = feedback.movie_id
                                  AND feedback.user_id = user_details.user_id
                                  AND movie.movie_id = $movie_id
                                  ORDER BY movie.movie_id desc;";
                    $result = mysqli_query($con, $sel_query);

                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row["movie_name"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["comment"]; ?></td>
                            <td><?php echo $row["dateposed"]; ?></td>
                            <td>
                                <?php if (isset($row['user_id']) && $row['user_id'] == $current_user_id) { ?>
                                    <a href="../controllers/feedbackDelete.php?feedback_id=<?php echo htmlspecialchars($row["feedback_id"]); ?>&movie_id=<?php echo htmlspecialchars($movie_id); ?>" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</a>
                                    /
                                    <a href="../views/feedbackUpdate.php?feedback_id=<?php echo htmlspecialchars($row['feedback_id']); ?>&movie_id=<?php echo htmlspecialchars($movie_id); ?>" onclick="return confirm('Are you sure you want to update this feedback?')">Update</a>
                                <?php } else { ?>
                                    <span> </span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php $count++;
                    } ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row["movie_name"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["comment"]; ?></td>
                            <td><?php echo $row["dateposed"]; ?></td>
                        </tr>
                    <?php $count++;
                    } ?>
                </tbody>
            </table>

            <div class="rating-container text-center">
                <div class="button-group">
                    <a href="feedbackAdd.php?movie_id=<?php echo $movie_id; ?>" class="btn btn-primary me-3">Add a Feedback</a>
                </div>
            </div>
        </div>

        <br><br>
        <p class="float-end"><a href="userHome.php" class="btn btn-secondary mt-4">Back</a></p>
        <p>&copy; 2024 Group Assignment &middot;</p>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>