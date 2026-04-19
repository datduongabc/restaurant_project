<?php

require_once ROOT_PATH . '/app/modules/user/admin_user_service.php';

class AdminUserController
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new AdminUserService();
    }

    public function getAllUsersForAdmin()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN') {
            return $this->adminService->getAllUsersForAdmin();
        }
    }
}
