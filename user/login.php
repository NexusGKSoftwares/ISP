<?php
session_start();
include('config/db.php'); // Include database connection file
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM users WHERE email = :email"; 
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Set session variable for user ID
        header('Location: dashboard.php'); // Redirect to dashboard if successful
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">


<section class="bg-dark text-white">
  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          Welcome back!
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          Please log in to your account to continue.
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div class="card bg-dark text-white">
          <div class="card-body px-4 py-5 px-md-5">
            <form method="POST" action="login.php">
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form3Example1" class="form-control" name="email" required />
                <label class="form-label" for="form3Example1">Email address</label>
              </div>

              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form3Example2" class="form-control" name="password" required />
                <label class="form-label" for="form3Example2">Password</label>
              </div>

              <button type="submit" class="btn btn-primary btn-block mb-4">Log In</button>

              <div class="text-center">
                <p>Forgot your password? <a href="forgot_password.php">Reset it here</a></p>
                <p>Don't have an account? <a href="register.php" class="text-primary">Register here</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
