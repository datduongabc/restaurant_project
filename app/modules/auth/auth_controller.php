<?php

require_once ROOT_PATH . '/app/modules/auth/auth_service.php';

class AuthController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    // Sign up controller
    public function signUp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = trim($_POST['name'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $phone    = $_POST['phone'] ?? '';

            $result = $this->authService->signUpLogic($name, $email, $password, $phone);

            if ($result['success']) {
                $_SESSION['auth_success'] = $result['message'];
                header("Location: index.php?page=signin");
            } else {
                $_SESSION['auth_error'] = $result['message'];
                header("Location: index.php?page=signup");
            }
            exit();
        }

        // GET Method: Display the registration form
        require_once ROOT_PATH . '/app/modules/auth/views/sign_up.php';
    }

    // Sign in controller
    public function signIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email       = trim($_POST['email'] ?? '');
            $password    = $_POST['password'] ?? '';
            $remember_me = isset($_POST['remember']);

            $result = $this->authService->signInLogic($email, $password);

            if ($result['success']) {
                $_SESSION['user_id'] = $result['userInfo']['id'];
                $_SESSION['name'] = $result['userInfo']['name'];
                $_SESSION['role'] = $result['userInfo']['role'];
                $_SESSION['is_email_verified'] = $result['userInfo']['is_email_verified'];

                if ($remember_me) {
                    $this->authService->rememberMeLogic($result['userInfo']['id']);
                }

                $_SESSION['auth_success'] = $result['message'];
                header("Location: index.php");
            } else {
                $_SESSION['auth_error'] = $result['message'];
                header("Location: index.php?page=signin");
            }
            exit();
        }

        // GET Method: Display login form
        require_once ROOT_PATH . '/app/modules/auth/views/sign_in.php';
    }

    // Auto sign in if user has cookie
    public function signInWithToken()
    {
        if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
            $result = $this->authService->signInWithToken($_COOKIE['remember_me']);

            if ($result["success"]) {
                $_SESSION['user_id'] = $result["userInfo"]['id'];
                $_SESSION['name'] = $result['userInfo']['name'];
                $_SESSION['role'] = $result['userInfo']['role'];
                $_SESSION['is_email_verified'] = $result['userInfo']['is_email_verified'];

                $_SESSION['auth_success'] = $result['message'];
                header("Location: index.php");
            } else {
                $_SESSION['auth_error'] = $result['message'];
                header("Location: index.php?page=signin");
            }
            exit();
        }
    }

    // Sign out controller
    public function signOut()
    {
        if (isset($_COOKIE['remember_me'])) {
            $this->authService->revokeToken($_COOKIE['remember_me']);
            setcookie('remember_me', '', time() - 3600, '/'); // Set cookie value in the past
        }

        session_unset();
        session_regenerate_id(true);
        header("Location: index.php?page=signin");
        exit();
    }

    // Forgot password controller
    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $type = 'FORGOT_PASSWORD';
            $this->authService->initiateSecureProcess($email, $type);

            $_SESSION["email"] = $email;
            $_SESSION["auth_type"] = 'FORGOT_PASSWORD';

            // Success or unsuccess, redirect to input secure token page
            header("Location: index.php?page=secure_token");
            exit();
        }

        // GET Method: Display the forgot password form
        require_once ROOT_PATH . '/app/modules/auth/views/forgot_password.php';
    }

    public function secureToken()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION["email"] ?? '';
            $type = $_SESSION["auth_type"] ?? '';

            if (empty($email) || empty($type)) {
                header("Location: index.php?page=forgot_password");
                exit();
            }

            $plain_token = $_POST['secure_token'] ?? '';

            $result = $this->authService->validateTokenStep($email, $plain_token, $type);

            if (!$result["success"]) {
                $_SESSION['auth_error'] = $result['message'];

                if ($result["message"] === "Too many attempts.") {
                    header("Location: index.php?page=forgot_password");
                    exit();
                }

                header("Location: index.php?page=secure_token");
            } else {
                $_SESSION['token_verified'] = true;

                if ($type === 'EMAIL_VERIFICATION') {
                    $this->authService->verifyEmailLogic($email);
                    unset($_SESSION['email'], $_SESSION['token_verified'], $_SESSION['auth_type']);
                    $_SESSION['auth_success'] = "Email verified! You can now enjoy full features.";
                    header("Location: index.php");
                } else {
                    header("Location: index.php?page=reset_password");
                }
            }
            exit();
        }

        // GET Method: Display the secure token form
        require_once ROOT_PATH . '/app/modules/auth/views/secure_token.php';
    }

    public function resetPassword()
    {
        if (!isset($_SESSION['token_verified']) || !isset($_SESSION['email'])) {
            header("Location: index.php?page=forgot_password");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['email'];
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if ($new_password !== $confirm_password) {
                $_SESSION['auth_error'] = "Passwords do not match.";
                header("Location: index.php?page=reset_password");
            } else {
                $type = $_SESSION['auth_type'] ?? 'FORGOT_PASSWORD';
                $result = $this->authService->createNewPassword($email, $new_password, $type);

                if ($result['success']) {
                    unset($_SESSION['email'], $_SESSION['token_verified'], $_SESSION['auth_type']);

                    $_SESSION['auth_success'] = "Password changed successfully! Please log in again.";
                    header("Location: index.php?page=signin");
                } else {
                    $_SESSION['auth_error'] = $result['message'];
                    header("Location: index.php?page=reset_password");
                }
            }
            exit();
        }

        require_once ROOT_PATH . '/app/modules/auth/views/reset_password.php';
    }

    public function changePassword()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['auth_error'] = "Vui lòng đăng nhập để thực hiện chức năng này.";
            header("Location: index.php?page=signin");
            exit();
        }

        $user_id = $_SESSION['user_id'];

        $user_result = $this->authService->getUserInfoById($user_id);
        $email = $user_result['email'] ?? '';

        if (empty($email)) {
            $_SESSION['auth_error'] = "Không tìm thấy thông tin email.";
            header("Location: index.php");
            exit();
        }

        $this->authService->initiateSecureProcess($email, 'CHANGE_PASSWORD');

        $_SESSION["email"] = $email;
        $_SESSION["auth_type"] = 'CHANGE_PASSWORD';

        header("Location: index.php?page=secure_token");
        exit();
    }

    public function verifyEmailRequest()
    {
        // 1. Kiểm tra session cơ bản
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=signin");
            exit();
        }

        $user = $this->authService->getUserInfoById($_SESSION['user_id']);
        $email = $user['email'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->authService->initiateSecureProcess($email, 'EMAIL_VERIFICATION');

            if ($result === true) {
                $_SESSION['email'] = $email;
                $_SESSION['auth_type'] = 'EMAIL_VERIFICATION';
                header("Location: index.php?page=secure_token");
                exit();
            } else {
                $_SESSION['auth_error'] = is_array($result) ? $result['message'] : "Could not send email. Please try again.";
                header("Location: index.php?page=verify_email");
                exit();
            }
        }

        // method GET
        require_once ROOT_PATH . '/app/modules/auth/views/verify_email.php';
    }
}
