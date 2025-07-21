<?php
require('../models/database.php');

$id = $_GET['user_id'];

// Deleting all feedback associated with the user
$delete_rating_query = "DELETE FROM rating WHERE user_id = $id";
mysqli_query($con, $delete_rating_query) or die(mysqli_error($con));

// Deleting all feedback associated with the user
$delete_feedback_query = "DELETE FROM feedback WHERE user_id = $id";
mysqli_query($con, $delete_feedback_query) or die(mysqli_error($con));

// Deleting the user
$delete_user_query = "DELETE FROM user_details WHERE user_id = $id";
mysqli_query($con, $delete_user_query) or die(mysqli_error($con));

header("Location: ../views/profileDelete.php");
exit();
