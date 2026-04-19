<?php

session_start();

define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/vendor/autoload.php'; // php mailer
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// customer
require_once ROOT_PATH . '/app/modules/auth/auth_controller.php';
require_once ROOT_PATH . '/app/modules/product/product_controller.php';
require_once ROOT_PATH . '/app/modules/menu/menu_controller.php';
require_once ROOT_PATH . '/app/modules/reservation/reservation_controller.php';
// admin
require_once ROOT_PATH . '/app/modules/product/admin_product_controller.php';
require_once ROOT_PATH . '/app/modules/user/admin_user_controller.php';
require_once ROOT_PATH . '/app/modules/reservation/admin_reservation_controller.php';


$page = $_GET['page'] ?? 'main';
$auth_controller = new AuthController();
$product_controller = new ProductController();
$reservation_controller = new ReservationController();
$menu_controller = new MenuDetailController();
// admin
$admin_product = new AdminProductController();
$admin_user = new AdminUserController();
$admin_reservation = new AdminReservationController();

// Automatically login
$auth_controller->signInWithToken();

// Reservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'main') {
    $reservation_controller->createReservation();
}

switch ($page) {
    case 'signup':
        $auth_controller->signUp();
        break;

    case 'signin':
        $auth_controller->signIn();
        break;

    case 'signout':
        $auth_controller->signOut();
        break;

    case 'forgot_password':
        $auth_controller->forgotPassword();
        break;

    case 'change_password':
        $auth_controller->changePassword();
        break;

    case 'secure_token':
        $auth_controller->secureToken();
        break;

    case 'reset_password':
        $auth_controller->resetPassword();
        break;

    case 'verify_email':
        $auth_controller->verifyEmailRequest();
        break;

    case 'detail':
        $menu_controller->showDetail();
        break;

    case 'product_sort':
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $limit = 12;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

        $product_controller = new ProductController();
        $data = $product_controller->getProductsPaginated($page, $limit, $sort);

        $products = $data['products'];
        $current_page = $data['current_page'];
        $total_pages = $data['total_pages'];

        include ROOT_PATH . '/app/modules/product/views/menu_list_pagination.php';
        exit();

    case 'product_search':
        include __DIR__ . '/api/search.php';
        exit();

    case 'main':
    default:
        if (isset($_SESSION['role']) && ($_SESSION['role'] === 'CUSTOMER')) {
            include ROOT_PATH . '/app/modules/user/views/customer_page.php'; // For customer
        } else if (isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN') {
            include ROOT_PATH . '/app/modules/user/views/admin_page.php'; // For admin
            if ($page === "admin_products") {
                $admin_product->getAllProductsForAdmin();
            } else if ($page === "admin_users") {
                $admin_user->getAllUsersForAdmin();
            } else {
                $admin_reservation->getAllReservationsForAdmin();
            }
        } else {
            include ROOT_PATH . '/app/modules/user/views/customer_page.php'; // For guest
        }
        break;
}
