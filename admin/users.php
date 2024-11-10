<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div>
    <h2 class="text-center">Manage Users</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll();
            foreach ($users as $user):
            ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo isset($user['name']) ? htmlspecialchars($user['name']) : 'N/A'; ?></td>
                    <td><?php echo isset($user['email']) ? htmlspecialchars($user['email']) : 'N/A'; ?></td>
                    <td><?php echo isset($user['phone_number']) ? htmlspecialchars($user['phone_number']) : 'N/A'; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
