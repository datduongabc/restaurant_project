<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Detail</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/style.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/header.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/footer.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/menu_detail.css">
    <script src="/restaurant_project/public/js/header/search.js" defer></script>
</head>

<body>
    <?php include ROOT_PATH . '/app/core/views/layouts/header.php'; ?>

    <main class="py-5 bg-pure-white">
        <div class="container mt-4">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="?page=home" class="text-decoration-none text-teal-dark">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="?page=home#menu-list" class="text-decoration-none text-teal-dark">Menu</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?= htmlspecialchars($product['name'] ?? $product['name']) ?>
                    </li>
                </ol>
            </nav>

            <div class="row align-items-center bg-light rounded-4 shadow-sm p-4 p-md-5">
                <div class="col-md-6 mb-4 mb-md-0 text-center">
                    <img src="<?= htmlspecialchars($product['image_path']) ?>"
                        alt="<?= htmlspecialchars($product['name']) ?>"
                        class="img-fluid rounded-4 shadow object-fit-cover"
                        style="max-height: 450px; width: 100%; cursor: pointer;">
                </div>

                <div class="col-md-6 ps-md-5">
                    <span class="badge text-teal-dark mb-3">
                        <?= htmlspecialchars($product['category_name']) ?>
                    </span>

                    <h2 class="fw-bold text-teal-dark mb-3 fs-2">
                        <?= htmlspecialchars($product['name']) ?>
                    </h2>

                    <h3 class="text-primary-orange fw-bold mb-4 fs-2">
                        <?= htmlspecialchars($product['price']) ?>đ
                    </h3>

                    <p class="text-muted lead mb-4 fs-5">
                        <?= htmlspecialchars($product['description']) ?>
                    </p>

                    <hr class="mb-4 border-secondary opacity-25">

                    <form action="?page=cart&action=add" method="POST" class="d-flex align-items-center gap-3">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id'] ?? 1) ?>">

                        <div style="width: 100px;">
                            <input
                                type="number"
                                class="form-control text-center fw-bold custom-qty-input"
                                name="quantity"
                                id="qty-input"
                                value="1"
                                min="1"
                                max="10">
                        </div>

                        <button type="submit" class="btn btn-custom-primary btn-lg flex-grow-1">
                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include ROOT_PATH . '/app/core/views/layouts/footer.php'; ?>
</body>

</html>
