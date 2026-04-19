<?php
require_once ROOT_PATH . '/app/modules/user/admin_user_controller.php';

$admin_user_controller = new AdminUserController();
$users = $admin_user_controller->getAllUsersForAdmin();
?>

<div class="container-fluid">
    <h2 class="mb-4">User Management</h2>
    <table class="table table-striped bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone number</th>
                <th>Is email verified</th>
                <th>Email verified at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['is_email_verified'] === 1 ? 'Verified' : 'Unverified' ?></td>
                    <td><?= $user['email_verified_at'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
