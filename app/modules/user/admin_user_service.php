<?php

require_once ROOT_PATH . '/app/modules/user/admin_user_model.php';

class AdminUserService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new AdminUserModel();
    }

    public function getAllUsersForAdmin()
    {
        $users = $this->userModel->getAllUsers();

        foreach ($users as &$user) {
            $user['role_label'] = ($user['role'] === 'admin') ? 'ADMIN' : 'CUSTOMER';
        }
        return $users;
    }
}
