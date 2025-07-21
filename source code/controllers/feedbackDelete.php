<?php
require('../models/database.php');

if (isset($_REQUEST['movie_id'])) {
    $movie_id = $_REQUEST['movie_id'];
} else {
    echo "Movie ID is missing.";
    exit;
}

$id = $_GET['feedback_id'];
$query = "DELETE FROM feedback WHERE feedback_id= '$id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
header("Location: userMovieDetail.php?movie_id=" . $movie_id);

exit();
