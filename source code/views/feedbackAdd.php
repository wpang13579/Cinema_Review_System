<?php
include("../controllers/userAuth.php");
require('../models/database.php');

if (isset($_REQUEST['movie_id'])) {
    $movie_id = $_REQUEST['movie_id'];
} else {
    echo "Movie ID is missing.";
    exit;
}

$status = "";

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $user_id = $_SESSION['user_id'];
    $comment = $_REQUEST['comment'];
    $dateposed = date("Y-m-d H:i:s");

    $ins_query = "INSERT into feedback (`movie_id`,`user_id`,`comment`,`dateposed`) values ('$movie_id','$user_id','$comment','$dateposed')";
    mysqli_query($con, $ins_query) or die(mysqli_error($con));
    $status = "New Feedback Added.";
}

$query = "SELECT * FROM movie WHERE movie_id='" . $movie_id . "'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Movie Feedback</title>
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
                            <a class="nav-link" href="#">Movie Rating</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userFeedback.php">Movie Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">User Profile</a>
                        </li>
                    </ul>
                    <a class="navbar-brand" href="../controllers/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="text-center my-5">
            <h1>Add Feedback</h1>
        </div>

        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <div class="mb-3">
                <label for="movie_id" class="form-label">Movie name: <?php echo $row["movie_name"]; ?></label>
            </div>

            <div class="mb-3">
                <input type="text" name="comment" class="form-control" placeholder="Enter Your Comment (Max 255 Words)" required />
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <p class="mt-3"><?php echo $status; ?></p>
        <a href="userMovieDetail.php?movie_id=<?php echo $movie_id; ?>">Back</a>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

</body>

</html>