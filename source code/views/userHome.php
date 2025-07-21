<?php
session_start(); // Start the session
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movie Review System</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
  <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#712cf9">
  <style>
    body {
      background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    main {
      padding-top: 56px;
      /* Adjust based on your navbar height */
    }

    .navbar-brand,
    .nav-link {
      color: #ffd700 !important;
    }

    footer {
      margin-top: 50px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      color: #ffd700;
    }

    footer a {
      color: #ffd700;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .card {
      background-color: rgba(0, 0, 0, 0.7);
      color: white;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .card-body h5,
    .card-body p {
      color: #ffd700;
    }

    .card-body a {
      color: #ffd700;
      text-decoration: none;
    }

    .card-body a:hover {
      text-decoration: underline;
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

  <main>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card h-100">
            <img src="../controllers/image/movie.png" class="card-img-top" alt="Movie List">
            <div class="card-body">
              <h5 class="card-title">Movie List</h5>
              <p class="card-text">Click for movie list.</p>
              <a href="userMovieList.php" class="btn btn-outline-light">Go</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card h-100">
            <img src="../controllers/image/rating.png" class="card-img-top" alt="Movie Rating">
            <div class="card-body">
              <h5 class="card-title">Top Movie Rating</h5>
              <p class="card-text">Click for our top movie rating.</p>
              <a href="userTopRankView.php" class="btn btn-outline-light">Go</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card h-100">
            <img src="../controllers/image/feedback.png" class="card-img-top" alt="Movie Feedback">
            <div class="card-body">
              <h5 class="card-title">Movie Feedback</h5>
              <p class="card-text">Click for display user feedback.</p>
              <a href="feedbackView.php" class="btn btn-outline-light">Go</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card h-100">
            <img src="../controllers/image/user.png" class="card-img-top" alt="User Profile">
            <div class="card-body">
              <h5 class="card-title">User Profile</h5>
              <p class="card-text">Click for user profile.</p>
              <a href="userProfile.php" class="btn btn-outline-light">Go</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="container">
    <p>&copy; 2024 Group Assignment &middot;</p>
  </footer>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>