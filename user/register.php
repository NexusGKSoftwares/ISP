<?php
// Include database connection
include('config/db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Password validation
    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the query and check if successful
        if ($stmt->execute()) {
            // Redirect to the login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>

<!-- Your HTML form remains the same -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Create your account
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Join us today and get started with our amazing services.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div class="card bg-dark text-white">
                        <div class="card-body px-4 py-5 px-md-5">
                            <form method="POST" action="register.php">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" name="first_name" required />
                                            <label class="form-label" for="first_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" name="last_name" required />
                                            <label class="form-label" for="last_name">Last Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" class="form-control" name="email" required />
                                    <label class="form-label" for="email">Email Address</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" class="form-control" name="password" required />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" class="form-control" name="confirm_password" required />
                                    <label class="form-label" for="confirm_password">Confirm Password</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4">Sign Up</button>

                                <div class="text-center">
                                    <p>Already have an account? <a href="login.php" class="text-primary">Log in here</a></p>
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
