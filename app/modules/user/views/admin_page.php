<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/restaurant_project/public/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body class="bg-light">
    <div class="d-flex">
        <aside class="admin-sidebar bg-teal-dark text-white p-3 shadow-lg">
            <h4 class="fw-bold text-center mb-4 py-3 border-bottom border-secondary">
                <span class="text-primary-orange">DaT</span>eNO Admin
            </h4>
            <nav class="nav flex-column gap-2">
                <a
                    href="index.php?page=admin_products"
                    class="nav-link text-white rounded">
                    <i class="bi bi-box-seam me-2"></i> Product Management
                </a>
                <a
                    href="index.php?page=admin_users"
                    class="nav-link text-white rounded">
                    <i class="bi bi-people me-2"></i> User Management
                </a>
                <a
                    href="index.php?page=admin_reservations"
                    class="nav-link text-white rounded">
                    <i class="bi bi-people me-2"></i> Reservation Management
                </a>
                <hr class="opacity-25">
                <a href="index.php?page=signout" class="nav-link text-danger fw-bold">
                    <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                </a>
            </nav>
        </aside>

        <main class="flex-grow-1 p-4 p-md-5">
            <?php
            if ($page === 'admin_products') {
                include ROOT_PATH . '/app/modules/product/views/admin_products.php';
            } else if ($page === 'admin_users') {
                include ROOT_PATH . '/app/modules/user/views/admin_users.php';
            } else {
                include ROOT_PATH . '/app/modules/reservation/views/admin_reservations.php';
            }
            ?>
        </main>
    </div>
</body>

</html>
