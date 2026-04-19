<?php
require_once ROOT_PATH . '/app/modules/product/product_controller.php';

$admin_product_controller = new AdminProductController();
$products = $admin_product_controller->getAllProductsForAdmin();
?>

<div class="container-fluid">
    <h2 class="mb-4">Product Management</h2>
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?>đ</td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['average_rating'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
