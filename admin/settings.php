<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<?php

include('includes/db.php');



// Fetch current settings from the database
$stmt = $pdo->prepare("SELECT * FROM settings WHERE id = 1");
$stmt->execute();
$settings = $stmt->fetch();

// Update settings
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_title = $_POST['site_title'];
    $currency = $_POST['currency'];
    $smtp_server = $_POST['smtp_server'];

    // Update settings in the database
    $stmt = $pdo->prepare("UPDATE settings SET site_title = ?, currency = ?, smtp_server = ? WHERE id = 1");
    $stmt->execute([$site_title, $currency, $smtp_server]);

    $success = "Settings updated successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div>
        <h2>System Settings</h2>

        <?php if (isset($success)) { echo "<p class='alert alert-success'>$success</p>"; } ?>

        <form method="POST" action="settings.php">
            <div class="mb-3">
                <label for="site_title" class="form-label">Site Title</label>
                <input type="text" class="form-control" id="site_title" name="site_title" value="<?php echo htmlspecialchars($settings['site_title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="currency" class="form-label">Currency</label>
                <input type="text" class="form-control" id="currency" name="currency" value="<?php echo htmlspecialchars($settings['currency']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="smtp_server" class="form-label">SMTP Server</label>
                <input type="text" class="form-control" id="smtp_server" name="smtp_server" value="<?php echo htmlspecialchars($settings['smtp_server']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>
    </div>
</body>
</html>
<?php include('includes/footer.php'); ?>
