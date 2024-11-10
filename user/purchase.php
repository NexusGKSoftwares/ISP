<?php
// purchase.php
include('config/db.php'); // Make sure this is included for PDO connection

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];
    
    // Use PDO to fetch package info
    $sql = "SELECT * FROM packages WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $package_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($package) {
        echo "You are about to purchase package: " . $package['name'];
    } else {
        echo "Package not found.";
    }
} else {
    echo "No package selected.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <section class="container py-5">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h3 class="card-title">Available Packages</h3>
                <p class="card-text">
                    Please choose a package to purchase:
                </p>
                <?php
                if ($packages) {
                    foreach ($packages as $row) {
                        echo "<a href='purchase.php?id=" . $row['id'] . "' class='btn btn-primary mb-2'>" . $row['package_name'] . " - $" . $row['price'] . "</a>";
                    }
                } else {
                    echo "No packages available.";
                }
                ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
