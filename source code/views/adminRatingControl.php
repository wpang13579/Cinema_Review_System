<?php
include("../controllers/adminAuth.php");
require('../models/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Rating Control</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center fixed;
            background-size: cover;
            color: white;
            overflow: hidden;
        }

        main {
            padding-top: 40px;
            /* Adjust based on your navbar height */
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1 1 calc(25% - 20px);
            max-width: calc(25% - 20px);
            min-width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: rgba(0, 0, 0, 0.7);
            border: none;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .navbar-brand,
        .nav-link {
            color: #ffd700 !important;
        }

        h1,
        h3,
        .card-title {
            color: #ffd700;
        }

        .back-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .back-button a {
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .back-button a:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="adminHome.php">AdminHome</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="movieDetail.php">Movie List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminRatingControl.php">Movie Rating</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminFeedbackControl.php">Movie Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profileManage.php">User Profile</a>
                        </li>
                    </ul>
                    <a class="navbar-brand" href="../controllers/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="text-center my-5">
            <h1>Admin Management</h1>
        </div>

        <div class="text-center mb-5">
            <h3>Rating Control</h3>
        </div>

        <div class="card-container">

            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">View Rating</h5>
                    <p class="card-text">View User Rating.</p>
                    <div class="btn-container">
                        <a href="adminRatingView.php" class="btn btn-success">View</a>
                    </div>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Delete Rating</h5>
                    <p class="card-text">Remove Bad Rating.</p>
                    <div class="btn-container">
                        <a href="adminRatingDelete.php" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="back-button">
            <a href="adminHome.php" class="btn btn-secondary">Back</a>
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>