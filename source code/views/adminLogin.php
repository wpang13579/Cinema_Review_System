<?php
session_start();
require('../models/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
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
            max-width: 600px;
            /* Adjusted for longer columns */
            width: 100%;
            margin: auto;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            /* Increased padding for a more substantial appearance */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }

        .container.fade-in {
            opacity: 1;
        }

        h2 {
            margin-bottom: 20px;
            color: #FFD700;
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
        if (isset($_POST['aName'])) {
            $aName = stripslashes($_REQUEST['aName']);
            $aName = mysqli_real_escape_string($con, $aName);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            $query = "SELECT * FROM `admin_details` WHERE admin_name='$aName' AND password='" . md5($password) . "'";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['admin'] = $row['admin_name'];
                $_SESSION['admin_id'] = $row['admin_id'];

                header("Location: adminHome.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Username/password is incorrect.</div>";
            }
        }
        ?>
        <form action="" method="post" name="login">
            <h2 class="mb-4">Admin Login</h2>
            <div class="mb-3">
                <input type="text" name="aName" class="form-control" placeholder="Admin Name" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
        <p class="float-end"><a href="main.php">Back</a></p>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>