<?php
require("../models/database.php");


$status = "";

if (isset($_REQUEST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $dob = $_REQUEST['dob'];
    $reg_date = date("Y-m-d H:i:s");

    $query = "INSERT INTO `user_details` (username, password, email, date_of_birth, reg_date)
              VALUES ('$username', '" . md5($password) . "', '$email','$dob', '$reg_date')";

    if ($result = mysqli_query($con, $query)) {
        $status = "New User Profile Added Successfully.<br><br><a href='profileView.php'>View User Profiles</a>";  // Set the flag to true if registration is successful
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Registration</title>
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
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
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

        h1,
        p {
            color: #FFD700;
        }

        .back-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
        }

        .back-button a {
            color: #FFD700;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h1>Add New User</h1>
        <form name="registration" action="" method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="date" name="dob" class="form-control" placeholder="Date of birth" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        <p class="mt-3"><?php echo $status; ?></p>
        <div class="back-button">
            <a href="profileManage.php">Back</a>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>