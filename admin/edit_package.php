<?php
include('includes/header.php');
include('includes/sidebar.php');
include('includes/db.php');

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM packages WHERE id = ?");
    $stmt->execute([$package_id]);
    $package = $stmt->fetch();
}

if (!$package) {
    echo "Package not found!";
    exit;
}
?>

<div>
    <h2>Edit Package</h2>
    <form action="update_package.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $package['id']; ?>">
        <div class="mb-3">
            <label for="package_name" class="form-label">Package Name</label>
            <input type="text" class="form-control" id="package_name" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="speed" class="form-label">Speed (Mbps)</label>
            <input type="number" class="form-control" id="speed" name="speed" value="<?php echo htmlspecialchars($package['speed']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (Ksh)</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($package['price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="validity_hours" class="form-label">Validity (hrs)</label>
            <input type="number" class="form-control" id="validity_hours" name="validity_hours" value="<?php echo htmlspecialchars($package['validity_hours']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Package</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
