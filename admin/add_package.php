<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div>
    <h2>Add New Package</h2>
    <form action="save_package.php" method="POST">
        <div class="mb-3">
            <label for="package_name" class="form-label">Package Name</label>
            <input type="text" class="form-control" id="package_name" name="package_name" required>
        </div>
        <div class="mb-3">
            <label for="speed" class="form-label">Speed (Mbps)</label>
            <input type="number" class="form-control" id="speed" name="speed" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (Ksh)</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="validity_hours" class="form-label">Validity (hrs)</label>
            <input type="number" class="form-control" id="validity_hours" name="validity_hours" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Package</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
