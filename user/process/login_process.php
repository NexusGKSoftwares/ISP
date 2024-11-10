<?php
include('../config/db.php');
include('../includes/auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (login($email, $password)) {
        header('Location: ../dashboard.php');
    } else {
        echo "Invalid login credentials.";
    }
}
?>
