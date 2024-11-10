<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div>
    <h2 class="text-center">Manage Packages</h2>
    <a href="add_package.php" class="btn btn-success mb-3">Add New Package</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Package Name</th>
                <th>Speed (Mbps)</th>
                <th>Price (Ksh)</th>
                <th>Validity (hrs)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM packages");
            $stmt->execute();
            $packages = $stmt->fetchAll();
            foreach ($packages as $package):
            ?>
                <tr>
                    <td><?php echo $package['id']; ?></td>
                    <td><?php echo htmlspecialchars($package['package_name']); ?></td>
                    <td><?php echo htmlspecialchars($package['speed']); ?></td>
                    <td><?php echo htmlspecialchars($package['price']); ?></td>
                    <td><?php echo htmlspecialchars($package['validity_hours']); ?></td>
                    <td>
                        <a href="edit_package.php?id=<?php echo $package['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_package.php?id=<?php echo $package['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
