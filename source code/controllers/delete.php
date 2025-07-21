<?php
require('../models/database.php');

$id = $_GET['movie_id'];
$query = "DELETE FROM movie WHERE movie_id=$id";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
header("Location: ../views/movieDelete.php");

exit();
