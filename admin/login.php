

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('includes/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check admin credentials
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch();

    // Verify password
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id']; // Set admin session
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();

    } else {
        $error = "Invalid username or password!";
        echo $admin['password'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Admin Login</h2>
        <form method="POST" action="login.php" class="mt-3">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
