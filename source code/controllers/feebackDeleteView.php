<?php
require('../models/database.php');

$id = $_GET['feedback_id'];

$query = "DELETE FROM feedback WHERE feedback_id= '$id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
header("Location: ../views/feedbackView.php");

exit();
