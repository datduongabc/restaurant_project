<?php

require_once ROOT_PATH . '/app/modules/product/product_model.php';

class ProductService
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function getHighestRating()
    {
        $product = $this->productModel->getFeatured();
        if ($product) {
            $product['image_path'] = $this->formatImagePath($product['category_slug'], $product['image_url']);
            return $product;
        }

        return null;
    }

    public function getPaginatedData($page, $limit, $sort)
    {
        $offset = ($page - 1) * $limit;

        $products = $this->productModel->getProducts($limit, $offset, $sort);
        $totalProducts = $this->productModel->countProducts($sort);

        foreach ($products as &$product) {
            $product['image_path'] = $this->formatImagePath($product['category_slug'], $product['image_url']);
        }

        return [
            'products' => $products,
            'current_page' => $page,
            'total_pages' => ceil($totalProducts / $limit)
        ];
    }

    // Helper function: Format image full path
    private function formatImagePath($category_slug, $image_name)
    {
        return "/restaurant_project/public/images/{$category_slug}/{$image_name}";
    }

    public function getProductsForAdmin()
    {
        return $this->productModel->getAllProductsForAdmin();
    }
}
