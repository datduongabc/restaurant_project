<?php

require_once ROOT_PATH . '/app/modules/product/product_service.php';

class AdminProductController
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new ProductService();
    }

    public function getAllProductsForAdmin()
    {
        return $this->adminService->getProductsForAdmin();
    }
}
