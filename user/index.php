<?php
include('config/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISP System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ISP System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="packages.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <header class="bg-primary text-white text-center py-5">
        <h1>Welcome to Our ISP System</h1>
        <p>Your trusted internet provider with reliable and affordable packages.</p>
        <a href="packages.php" class="btn btn-light btn-lg">Explore Packages</a>
    </header>

    <!-- Available Packages Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Our Packages</h2>
        <div class="row">
            <?php
            // Fetch available packages from the database
            $stmt = $pdo->prepare("SELECT * FROM packages");
            $stmt->execute();
            $packages = $stmt->fetchAll();

            foreach ($packages as $package):
            ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $package['name']; ?></h5>
                            <p class="card-text">Speed: <?php echo $package['speed']; ?></p>
                            <p class="card-text">Price: Ksh <?php echo $package['price']; ?></p>
                            <a href="dashboard.php?package_id=<?php echo $package['id']; ?>" class="btn btn-primary">Choose Package</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">About Us</h2>
            <p class="lead">We are a leading ISP provider committed to offering high-speed internet with reliable connectivity at affordable prices. Our aim is to ensure that your internet experience is fast, seamless, and dependable.</p>
            <a href="about.php" class="btn btn-dark">Learn More</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 ISP System. All Rights Reserved.</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="#" class="text-white">Terms of Service</a></li>
            <li class="list-inline-item"><a href="#" class="text-white">Contact</a></li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
