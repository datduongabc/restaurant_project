<?php
require_once ROOT_PATH . '/app/modules/product/product_controller.php';

$product_controller = new ProductController();
$highest_rating_item = $product_controller->getHighestRating();
?>

<!-- Best Seller Section -->
<section class="py-5">
    <div class=" container">
        <div class="row align-items-center">
            <!-- Left Side: Text Content -->
            <div class="col-lg-6 order-2 mt-4 mt-lg-0">
                <div class="ps-lg-4">
                    <span class="badge-best-seller mb-4">BEST SELLER</span>
                    <h3 class="fs-1 fw-bold mb-3"><?= htmlspecialchars($highest_rating_item['name']); ?></h3>
                    <p class="fs-2 fw-bold text-teal-dark">$<?= htmlspecialchars($highest_rating_item['price']); ?></p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-custom-primary btn-lg px-3 py-2 rounded-pill">
                            Order Now
                        </button>
                        <a
                            href="index.php?page=detail&slug=<?= htmlspecialchars($highest_rating_item['slug']); ?>"
                            class="btn btn-custom-teal btn-lg px-3 py-2 rounded-pill">View Detail
                        </a>
                    </div>
                </div>
            </div>

            <?php if ($highest_rating_item): ?>
                <div class="col-lg-6">
                    <div class="position-relative text-center">
                        <img src="<?= htmlspecialchars($highest_rating_item['image_path']); ?>"
                            alt="<?= htmlspecialchars($highest_rating_item['name']); ?>"
                            class="img-fluid rounded-3 shadow-lg food-img-hover"
                            style="width: 500px; height: 500px; object-fit: cover;">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
