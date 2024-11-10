<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISP User Panel - Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Checkout</h2>
        <form action="process/buy_package.php" method="POST">
            <input type="hidden" name="package_id" value="<?php echo $_GET['package_id']; ?>">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" id="amount" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

