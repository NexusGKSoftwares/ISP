<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div>
    <h2 class="text-center">Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Packages</h5>
                    <?php
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM packages");
                    $stmt->execute();
                    $totalPackages = $stmt->fetchColumn();
                    ?>
                    <p class="card-text"><?php echo $totalPackages; ?> packages available.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <?php
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
                    $stmt->execute();
                    $totalUsers = $stmt->fetchColumn();
                    ?>
                    <p class="card-text"><?php echo $totalUsers; ?> registered users.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Payments</h5>
                    <?php
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM payments");
                    $stmt->execute();
                    $totalPayments = $stmt->fetchColumn();
                    ?>
                    <p class="card-text"><?php echo $totalPayments; ?> payments made.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
