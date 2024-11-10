<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_name = $_POST['package_name'];
    $speed = $_POST['speed'];
    $price = $_POST['price'];
    $validity_hours = $_POST['validity_hours'];

    $stmt = $pdo->prepare("INSERT INTO packages (package_name, speed, price, validity_hours) VALUES (?, ?, ?, ?)");
    $stmt->execute([$package_name, $speed, $price, $validity_hours]);

    header("Location: packages.php");
    exit;
}
?>
