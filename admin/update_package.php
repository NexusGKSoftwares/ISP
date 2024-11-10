<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $package_name = $_POST['package_name'];
    $speed = $_POST['speed'];
    $price = $_POST['price'];
    $validity_hours = $_POST['validity_hours'];

    $stmt = $pdo->prepare("UPDATE packages SET package_name = ?, speed = ?, price = ?, validity_hours = ? WHERE id = ?");
    $stmt->execute([$package_name, $speed, $price, $validity_hours, $id]);

    header("Location: packages.php");
    exit;
}
?>
