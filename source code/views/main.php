<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Review System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        function redirectTo(page) {
            window.location.href = page;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.classList.add('fade-in');
        });
    </script>

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

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn {
            width: 150px;
            transition: transform 0.3s;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        h1,
        h2 {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container text-center fade-in">
        <h1 class="mb-4">Movie Review System</h1>
        <h2 class="mb-4">Choose Your Login Type</h2>
        <div class="btn-container">
            <button onclick="redirectTo('userLogin.php')" class="btn btn-primary btn-lg">User</button>
            <button onclick="redirectTo('adminLogin.php')" class="btn btn-secondary btn-lg">Admin</button>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>