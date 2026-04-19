<?php
require_once ROOT_PATH . '/app/modules/product/product_service.php';

class ProductController
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function getHighestRating()
    {
        return $this->productService->getHighestRating();
    }

    public function getProductsPaginated($page, $limit, $sort)
    {
        return $this->productService->getPaginatedData($page, $limit, $sort);
    }
}
