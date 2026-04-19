<?php

require_once ROOT_PATH . '/app/modules/menu/menu_model.php';

class MenuDetailService
{
    private $menuDetailModel;

    public function __construct()
    {
        $this->menuDetailModel = new MenuDetailModel();
    }

    public function getProductDetail($slug)
    {
        $product = $this->menuDetailModel->getProductBySlug($slug);

        if ($product) {
            $product['image_path'] = $this->formatImagePath($product['category_slug'], $product['image_url']);
        }

        return $product;
    }

    // Helper function: Format image full path
    private function formatImagePath($category_slug, $image_name)
    {
        return "/restaurant_project/public/images/{$category_slug}/{$image_name}";
    }
}
