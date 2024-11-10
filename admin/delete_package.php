<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM packages WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: packages.php");
    exit;
}
?>
