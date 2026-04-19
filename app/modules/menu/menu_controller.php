<?php

require_once ROOT_PATH . '/app/modules/menu/menu_service.php';

class MenuDetailController
{
    private $menuDetailService;

    public function __construct()
    {
        $this->menuDetailService = new MenuDetailService();
    }
    public function showDetail()
    {
        $slug = $_GET['slug'];
        $product = $this->menuDetailService->getProductDetail($slug);
        include ROOT_PATH . '/app/modules/menu/views/menu_detail.php';
        exit();
    }
}
