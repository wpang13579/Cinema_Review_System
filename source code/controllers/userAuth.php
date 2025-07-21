<?php
// need authorize
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../views/userLogin.php");
    exit();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/userLogin.php");
    exit();
}
