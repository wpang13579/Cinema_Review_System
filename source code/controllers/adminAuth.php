<?php
// need authorize
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: ../views/adminLogin.php");
    exit();
}
