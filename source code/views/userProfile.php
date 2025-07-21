<?php
session_start();
require('../models/database.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: userLogin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle Update request
if (isset($_POST['update'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $dob = $_POST['dob'];

    $update_query = "UPDATE user_details SET username='$username', email='$email', date_of_birth='$dob' WHERE user_id='$user_id'";
    mysqli_query($con, $update_query);
    echo "<div class='alert alert-success'>Profile updated successfully.</div>";
}

// Handle Delete request
if (isset($_POST['delete'])) {

    // Deleting all feedback associated with the user
    $delete_rating_query = "DELETE FROM rating WHERE user_id = $user_id";
    mysqli_query($con, $delete_rating_query) or die(mysqli_error($con));

    // Deleting all feedback associated with the user
    $delete_feedback_query = "DELETE FROM feedback WHERE user_id = $user_id";
    mysqli_query($con, $delete_feedback_query) or die(mysqli_error($con));

    // Deleting the user
    $delete_user_query = "DELETE FROM user_details WHERE user_id = $user_id";
    mysqli_query($con, $delete_user_query) or die(mysqli_error($con));
 

    session_destroy();
    header("Location: userLogin.php");
    exit();
}

// Fetch user info
$user_query = "SELECT * FROM user_details WHERE user_id='$user_id'";
$result = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Profile</title>
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

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
            max-width: 500px;
        }

        .navbar-brand,
        .nav-link {
            color: #ffd700 !important;
        }

        .form-control {
            background: none;
            border: 2px solid white;
            border-radius: 0;
            color: white;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #FFD700;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #FFD700;
            border-color: #FFD700;
        }

        .btn-primary:hover {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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

    <div class="container">
        <h1 class="text-center mb-4">User Profile</h1>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                <button type="submit" name="delete" class="btn btn-danger">Delete Account</button>
            </div>
        </form>
        <br>
        <div class="text-end">
            <a href="userHome.php" class="btn btn-secondary mt-4">Back</a>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>