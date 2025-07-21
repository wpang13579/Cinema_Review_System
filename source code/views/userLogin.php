<?php
session_start();
require('../models/database.php');

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: userHome.php");
    exit();
}

// Check if "Remember Me" cookie is set
if (isset($_COOKIE['user'])) {
    $username = $_COOKIE['user'];

    // Fetch user details from database
    $query = "SELECT * FROM `user_details` WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];

        header("Location: userHome.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }

        .container.fade-in {
            opacity: 1;
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

        a {
            color: #FFD700;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.classList.add('fade-in');
        });
    </script>
</head>

<body>
    <div class="container text-center">
        <?php
        if (isset($_POST['email'])) {
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            $query = "SELECT * FROM `user_details` WHERE email='$email' AND password='" . md5($password) . "'";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['user_id'];

                if (isset($_POST['remember_me'])) {
                    setcookie("user", $row['username'], time() + 86400 * 30, "/");
                }
                header("Location: userHome.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Username or password is incorrect.</div>";
            }
        }
        ?>
        <form action="" method="post" name="login">
            <h2 class="mb-4 text-center">User Login</h2>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember_me" class="form-check-input" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember Me</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <p class="mt-3">Not registered yet? <a href='userRegistration.php'>Register Here</a></p>
        </form>

        <p class="float-end"><a href="main.php">Back</a></p>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>