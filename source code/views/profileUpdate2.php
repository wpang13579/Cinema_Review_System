<?php
include("../controllers/adminAuth.php");
require('../models/database.php');

if (isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
} else {
    echo "User ID is missing.";
    exit;
}

$query = "SELECT * FROM user_details WHERE user_id='" . $user_id . "'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update User Profile</title>
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
    <div class="container">
        <div class="text-center my-4">
            <h1>Update User Profile</h1>
        </div>
        <?php
        $status = "";
        if (isset($_POST['update']) && $_POST['update'] == 1) {
            $user_id = $_REQUEST['user_id'];
            $username = $_REQUEST['username'];
            $email = $_REQUEST['email'];
            $date_of_birth = $_REQUEST['date_of_birth'];

            $update = "UPDATE user_details SET username='" . $username . "', email='" . $email . "', date_of_birth='" . $date_of_birth . "' WHERE user_id='" . $user_id . "'";
            mysqli_query($con, $update) or die(mysqli_error($con));
            $status = "User Profile Updated Successfully. </br></br> <a href='profileUpdate.php'>View Updated Profiles</a>";
            echo '<p style="color:#008000;">' . $status . '</p>';
        } else {
        ?>
            <form name="form" method="post" action="">
                <input type="hidden" name="update" value="1" />
                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>" />

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        <?php } ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>