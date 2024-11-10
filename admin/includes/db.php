<?php
$host = 'localhost';
$db = 'isp_billing';
$user = 'root'; // Change this if you use a different username
$pass = ''; // Change this if you use a different password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
