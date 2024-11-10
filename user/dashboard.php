<?php
include('config/db.php');
include('includes/auth.php');

if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

// Fetch user information
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM purchases WHERE user_id = ?");
$stmt->execute([$userId]);
$purchases = $stmt->fetchAll();
?>
<?php
// Purchase.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = $_POST['phone_number'];
    $package_id = $_POST['package_id'];  // Package info from hidden input

    // Set M-Pesa credentials (Replace with your own credentials)
    $shortcode = 'your_shortcode';
    $lipa_na_mpesa_shortcode = 'your_shortcode';
    $lipa_na_mpesa_shortcode_secret = 'your_shortcode_secret';
    $lipa_na_mpesa_shortcode_passkey = 'your_passkey';

    // API endpoint
    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    // Headers
    $headers = [
        'Authorization: Bearer ' . getAccessToken(), // Assuming getAccessToken() gets your access token
        'Content-Type: application/json',
    ];

    // Data to send
    $data = json_encode([
        'BusinessShortCode' => $lipa_na_mpesa_shortcode,
        'Password' => base64_encode($lipa_na_mpesa_shortcode . $lipa_na_mpesa_shortcode_passkey),
        'LipaNaMpesaOnlineShortcode' => $shortcode,
        'PhoneNumber' => $phone_number,
        'Amount' => 1000,  // Example price for the package, this should be dynamically pulled from the package info
        'AccountReference' => 'ISP12345',
        'TransactionDesc' => 'Package Payment',
    ]);

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Execute request
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle response
    echo $response;  // This would return the status of the STK push
}

function getAccessToken() {
    // Here, you would implement the logic to obtain an access token from Safaricom API.
    // Generally, it involves making a request to the Safaricom OAuth API.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="packages.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Packages Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Our Packages</h2>
        <div class="row">
            <?php
            // Fetch packages from the database
            $stmt = $pdo->prepare("SELECT * FROM packages");
            $stmt->execute();
            $packages = $stmt->fetchAll();

            foreach ($packages as $package):
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($package['package_name']); ?></h5>
                            <p class="card-text">Speed: <?php echo htmlspecialchars($package['speed']); ?> Mbps</p>
                            <p class="card-text">Price: Ksh <?php echo htmlspecialchars($package['price']); ?></p>
                            <p class="card-text">Validity: <?php echo htmlspecialchars($package['validity_hours']); ?> hours</p>
                            <!-- Trigger Modal -->
                            <a href="#" data-toggle="modal" data-target="#purchaseModal_<?php echo $package['id']; ?>" class="btn btn-primary">BUY</a>

                            <!-- Modal -->
                            <div class="modal fade" id="purchaseModal_<?php echo $package['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="purchaseModalLabel_<?php echo $package['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="purchaseModalLabel_<?php echo $package['id']; ?>">Purchase Package: <?php echo htmlspecialchars($package['package_name']); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Description:</strong> <?php echo htmlspecialchars($package['description']); ?></p>
                                            <p><strong>Speed:</strong> <?php echo htmlspecialchars($package['speed']); ?> Mbps</p>
                                            <p><strong>Price:</strong> Ksh <?php echo htmlspecialchars($package['price']); ?></p>
                                            <p><strong>Validity:</strong> <?php echo htmlspecialchars($package['validity_hours']); ?> hours</p>
                                            <form action="purchase_success.php" method="POST">
                                                <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number for Payment:</label>
                                                    <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                                                </div>
                                                <button type="submit" class="btn btn-success mt-3">Confirm Purchase</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 ISP System. All Rights Reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Modal trigger handling for each package
        $(".btn-primary").click(function() {
            var targetModal = $(this).data('target');
            $(targetModal).modal('show');
        });
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
