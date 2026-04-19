<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/style.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/header.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/best_seller.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/menu_list.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/feedback.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/reservation.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/footer.css">
    <!-- Search, sort -->
    <script src="/restaurant_project/public/js/reservation/reservation.js" defer></script>
    <script src="/restaurant_project/public/js/header/search.js" defer></script>
    <script src="/restaurant_project/public/js/menu/sort.js" defer></script>
</head>

<body>
    <header>
        <?php include ROOT_PATH . '/app/core/views/layouts/header.php'; ?>
    </header>

    <main>
        <?php
        include ROOT_PATH . '/app/modules/product/views/best_seller.php';
        include ROOT_PATH . '/app/modules/product/views/menu_title.php';
        include ROOT_PATH . '/app/modules/feedback/views/feedback.php';
        include ROOT_PATH . '/app/modules/reservation/views/reservation.php';
        ?>
    </main>

    <?php include ROOT_PATH . '/app/core/views/layouts/footer.php'; ?>

</body>

</html>
