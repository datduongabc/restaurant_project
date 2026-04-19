<?php

require_once ROOT_PATH . '/app/modules/product/product_controller.php';

$product_controller = new ProductController();
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$limit = 12; // Get LCM of (1, 3, 4, 6) items
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

$data = $product_controller->getProductsPaginated($page, $limit, $sort);
$products = $data['products'];
$current_page = $data['current_page'];
$total_pages = $data['total_pages'];
?>

<!-- Menu List -->
<section class="py-5" id="menu-list">
    <div class="container">
        <div class="row align-items-center mb-5 gy-3">
            <div class="col-md-3 d-none d-md-block"></div>
            <header class="col-12 col-md-6 text-center">
                <h2 class="fw-bold text-teal-dark mb-0">Menu List</h2>
            </header>

            <div class="col-12 col-md-3 text-center text-md-end">
                <div class="sort-container d-inline-block">
                    <div class="d-flex align-items-center gap-2">
                        <?php $current_sort = $_GET['sort'] ?? 'default'; ?>

                        <label
                            for="sort-dropdown"
                            class="text-muted small fw-bold text-nowrap mb-0">
                            Sort By:
                        </label>
                        <select
                            name="sort"
                            id="sort-dropdown"
                            class="form-select form-select-sm border-0 shadow-sm">
                            <!-- Only single sort -->
                            <option value="default" <?= $current_sort === 'default' ? 'selected' : '' ?>>
                                Default
                            </option>

                            <optgroup label="Price">
                                <option value="price_asc" <?= $current_sort === 'price_asc' ? 'selected' : '' ?>>
                                    Low to High
                                </option>
                                <option value="price_desc" <?= $current_sort === 'price_desc' ? 'selected' : '' ?>>
                                    High to Low
                                </option>
                            </optgroup>

                            <optgroup label="Rating">
                                <option value="rating_asc" <?= $current_sort === 'rating_asc' ? 'selected' : '' ?>>
                                    Low to High
                                </option>
                                <option value="rating_desc" <?= $current_sort === 'rating_desc' ? 'selected' : '' ?>>
                                    High to Low
                                </option>
                            </optgroup>

                            <optgroup label="Category">
                                <option value="starters" <?= $current_sort === 'starters' ? 'selected' : '' ?>>
                                    Starters
                                </option>
                                <option value="main_dishes" <?= $current_sort === 'main_dishes' ? 'selected' : '' ?>>
                                    Main Dishes
                                </option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4" id="ajax-product-container">
            <?php include ROOT_PATH . '/app/modules/product/views/menu_list_pagination.php' ?>
        </div>
    </div>
</section>
