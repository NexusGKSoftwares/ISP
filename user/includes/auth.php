<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function login($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email, md5($password)]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
    header("Location: ../index.php");
}
?>
