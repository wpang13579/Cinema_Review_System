<?php
    include("../controllers/adminAuth.php");
    require('../models/database.php');


    $rating_id=$_GET["rating_id"];
    $query="DELETE FROM rating WHERE rating_id=$rating_id";
    $result=mysqli_query($con,$query)or die (mysqli_error($con));
    header("Location: ../views/adminRatingView.php");
    exit();



?>