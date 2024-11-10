<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageId = $_POST['package_id'];
    $amount = $_POST['amount'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO purchases (user_id, package_id, amount) VALUES (?, ?, ?)");
    if ($stmt->execute([$userId, $packageId, $amount])) {
        header('Location: ../dashboard.php?success=1');
    } else {
        echo "Error processing your purchase.";
    }
}
?>
