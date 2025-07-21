<?php
include("../controllers/userAuth.php");
require('../models/database.php');

if (isset($_REQUEST['movie_id'])) {
    $movie_id = htmlspecialchars($_REQUEST['movie_id']); // Sanitize the movie_id
} else {
    echo "Movie ID is missing.";
    exit;
}

if (isset($_GET["rating_id"])) {
    $rating_id = intval($_GET["rating_id"]); // Validate and sanitize rating_id as an integer
} else {
    echo "Rating ID is missing.";
    exit;
}

// Construct the query with the sanitized values
$query = "DELETE FROM rating WHERE rating_id=$rating_id";
$result = mysqli_query($con, $query) or die(mysqli_error($con));

// Redirect to the movie detail page
header("Location: ../views/userMovieDetail.php?movie_id=" . urlencode($movie_id));
exit();
