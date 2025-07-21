<?php
include("../controllers/userAuth.php");
require('../models/database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>View Movie List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        main {
            padding-top: 60px;
            width: 100%;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
        }

        table {
            width: 100%;
            color: white;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #555;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        .navbar-brand,
        .nav-link {
            color: #ffd700 !important;
        }

        a {
            color: #ffd700;
        }

        a:hover {
            text-decoration: underline;
        }

        footer a {
            color: #ffd700;
        }

        footer a:hover {
            text-decoration: underline;
        }

        h1,
        h2,
        p {
            color: #ffd700;
        }
    </style>
</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="userHome.php">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="userMovieList.php">Movie List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userTopRankView.php">Top Movie Rating</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feedbackView.php">Movie Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userProfile.php">User Profile</a>
                        </li>
                    </ul>
                    <a class="navbar-brand" href="../controllers/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main content -->
    <main class="container">
        <div class="text-center my-5">
            <h2>Movie List</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Movie Name</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Profile Picture</th>
                        <th scope="col">View Feedback and Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $sel_query = "SELECT * FROM movie ORDER BY movie_id asc;";
                    $result = mysqli_query($con, $sel_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $profile_picture_path = '../controllers/uploads/' . basename($row["profile_picture"]);
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row["movie_name"]; ?></td>
                            <td><?php echo $row["genre"]; ?></td>
                            <td><?php echo $row["release_date"]; ?></td>
                            <td><?php echo $row["description"]; ?></td>
                            <td><img src="<?php echo $profile_picture_path; ?>" alt="Profile Picture" class="profile-picture" style="width: 50px; height: auto;"></td>
                            <td><a href="userMovieDetail.php?movie_id=<?php echo $row["movie_id"]; ?>">View</a></td>
                        </tr>
                    <?php $count++;
                    } ?>
                </tbody>
            </table>
        </div>
        <p class="float-end"><a href="userHome.php" class="btn btn-secondary mt-4">Back</a></p>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>