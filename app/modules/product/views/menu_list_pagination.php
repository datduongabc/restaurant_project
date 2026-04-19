<!-- Menu list body -->
<?php foreach ($products as $product): ?>
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card hover-card h-100 shadow-sm">
            <a
                href="/restaurant_project/public/index.php?page=detail&slug=<?= htmlspecialchars($product['slug']) ?>"
                class="text-decoration-none text-dark d-block">

                <img
                    src="<?= htmlspecialchars($product['image_path']) ?>"
                    alt="<?= htmlspecialchars($product['name']) ?>"
                    class="card-img-top d-block mx-auto"
                    style="width: 300px; height: 200px; object-fit: cover;" />
                <div
                    class="card-body text-center d-flex flex-column">
                    <h3 class="card-title fw-bold text-truncate fs-5">
                        <?= htmlspecialchars($product['name']) ?>
                    </h3>
                    <div class="mb-0">
                        <a
                            href="<?= htmlspecialchars($product['location_link']) ?>"
                            target="_blank"
                            title="<?= htmlspecialchars($product['location_address']) ?>"
                            class="text-muted fs-6 mb-0 text-truncate text-decoration-none d-block">
                            <?= $product['location_address'] ? htmlspecialchars($product['location_address']) : 'Location not specified' ?>
                        </a>
                        <p class="text-primary-orange fs-6 mt-1 mb-0">
                            $<?= $product['price'] ?>
                        </p>
                    </div>
                </div>
            </a>

            <div class="card-footer bg-transparent border-0 px-3 py-0">
                <button class="btn w-100 btn-custom-primary">Add to cart</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Displaying pagination -->
<div class="col-12 mt-5">
    <nav aria-label="Menu pagination">
        <ul class="pagination justify-content-center custom-pagination">
            <?php
            $sort_param = isset($_GET['sort']) ? '&sort=' . htmlspecialchars($_GET['sort']) : '';
            ?>

            <li class="page-product <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                <a
                    class="page-link"
                    href="?page=home&p=<?= $current_page - 1 ?><?= $sort_param ?>">Previous
                </a>
            </li>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-product <?= ($i === $current_page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=home&p=<?= $i ?><?= $sort_param ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <!-- Nút Trang sau -->
            <li class="page-product <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                <a
                    class="page-link"
                    href="?page=home&p=<?= $current_page + 1 ?><?= $sort_param ?>">Next
                </a>
            </li>
        </ul>
    </nav>
</div>
