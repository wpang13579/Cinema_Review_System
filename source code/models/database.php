<?php
// remmeber connect to cinema database, product-db for test case
$con = mysqli_connect("localhost", "root", "", "cinema_db");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
