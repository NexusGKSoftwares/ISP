<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div>
    <h2 class="text-center">Payment History</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>User</th>
                <th>Amount (Ksh)</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM payments");
            $stmt->execute();
            $payments = $stmt->fetchAll();
            foreach ($payments as $payment):
            ?>
                <tr>
                    <td><?php echo $payment['id']; ?></td>
                    <td><?php echo htmlspecialchars($payment['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    <td><?php echo htmlspecialchars($payment['status']); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
