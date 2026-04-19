<?php

require_once ROOT_PATH . '/app/modules/auth/auth_model.php';

use PHPMailer\PHPMailer\PHPMailer;

class AuthService
{
    private $authModel;
    const MAX_ATTEMPTS = 5;
    const TTL_REMEMBER_TOKEN = 10080;
    const TTL_SECURE_TOKEN = 15;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    // Helper function: Send email to user
    private function sendUniversalEmail($receiver, $token, $type)
    {
        $mail = new PHPMailer(true);

        try {
            // --- SMTP Server Configuration ---
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_EMAIL'];
            $mail->Password   = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // --- Sender & Receiver ---
            $mail->setFrom($_ENV['MAIL_EMAIL'], 'DaTeNO Restaurant');
            $mail->addAddress($receiver);

            $emailContent = match ($type) {
                'FORGOT_PASSWORD' => [
                    'subject' => 'Reset Your Password - DaTeNO',
                    'title'   => 'Password Reset Request',
                    'desc'    => 'Please use the token below to reset your password:'
                ],
                'EMAIL_VERIFICATION' => [
                    'subject' => 'Verify Your Account - DaTeNO',
                    'title'   => 'Account Verification',
                    'desc'    => 'Please use the token below to activate your account:'
                ],
                'CHANGE_PASSWORD' => [
                    'subject' => 'Security Alert: Password Change',
                    'title'   => 'Confirm Password Change',
                    'desc'    => 'Use this token to confirm you want to change your password:'
                ],
                default => [
                    'subject' => 'Security Token - DaTeNO',
                    'title'   => 'Security Verification',
                    'desc'    => 'Use the token below for your request:'
                ]
            };

            // --- Email Body Template ---
            $mail->isHTML(true);
            $mail->Subject = $emailContent['subject'];
            $mail->Body    = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;'>
                <div style='background-color: #0d9488; padding: 20px; text-align: center; color: white;'>
                    <h1 style='margin: 0;'>DaTeNO Restaurant</h1>
                </div>
                <div style='padding: 30px; line-height: 1.6; color: #374151;'>
                    <h2 style='color: #111827;'>{$emailContent['title']}</h2>
                    <p>{$emailContent['desc']}</p>
                    <div style='text-align: center; margin: 30px 0;'>
                        <span style='font-size: 32px; font-weight: bold; color: #0d9488; letter-spacing: 5px; background: #f0fdfa; padding: 10px 20px; border-radius: 4px; border: 1px dashed #0d9488;'>
                            $token
                        </span>
                    </div>
                    <p style='font-size: 14px; color: #6b7280;'>This token will expire in 15 minutes.</p>
                    <p style='font-size: 14px; color: #6b7280;'>If you did not request this, please ignore this email.</p>
                </div>
                <div style='background-color: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #9ca3af;'>
                    &copy; 2026 DaTeNO Restaurant. All rights reserved.
                </div>
            </div>
        ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    // Sign up logic
    public function signUpLogic($name, $email, $password, $phone)
    {
        // Server validation
        if (empty($name) || empty($email) || empty($password) || empty($phone)) {
            return [
                'success' => false,
                'message' => 'Please enter all fields.'
            ];
        }

        if (strlen($password) < 6) {
            return [
                'success' => false,
                'message' => 'Password must be at least 6 characters long.'
            ];
        }

        if (strlen($phone) !== 10 || !ctype_digit($phone)) {
            return [
                'success' => false,
                'message' => 'Invalid phone number.'
            ];
        }

        // checking unique email and phone number
        $duplicate = $this->authModel->checkDuplicateInfo($email, $phone);
        if ($duplicate) {
            if ($duplicate['email'] === $email) {
                return [
                    'success' => false,
                    'message' => 'Email already registered.'
                ];
            }
            if ($duplicate['phone'] === $phone) {
                return [
                    'success' => false,
                    'message' => 'Phone already registered.'
                ];
            }
        }

        // create and save new user in database
        $create_user = $this->authModel->createNewUser(
            $name,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $phone
        );

        if (!$create_user) {
            return [
                'success' => false,
                'message' => 'Sign up unsuccessful.'
            ];
        }

        // Mail account verification
        $is_email_sent = $this->initiateSecureProcess($email, 'EMAIL_VERIFICATION');

        if ($is_email_sent === true) {
            return [
                'success' => true,
                'message' => 'Sign up successful. Check email to verify account.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Sign up successful, but we could not send the verification email. Please try again later in your profile.'
        ];
    }

    // Sign in logic
    public function signInLogic($email, $password)
    {
        // Server validation
        if (empty($email) || empty($password)) {
            return [
                'success' => false,
                'message' => 'Please enter all fields.'
            ];
        }

        if (strlen($password) < 6) {
            return [
                'success' => false,
                'message' => 'Password must be at least 6 characters long.'
            ];
        }

        // Check user exist?
        $db_result = $this->authModel->getUserRecord($email);
        $user = $db_result['user_record'];

        // incorrect email or verify password not match
        if (!$user || !password_verify($password, $user["password"])) {
            return [
                'success' => false,
                'message' => 'Email or password are not correct.'
            ];
        }

        // Otherwise, return user info
        return [
            'success' => true,
            'userInfo' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role'],
                'is_email_verified' => $user['is_email_verified']
            ],
            "message" => "Sign in successfully."
        ];
    }

    public function initiateSecureProcess($email, $type)
    {
        $user = $this->authModel->getUserRecord($email);
        if (!$user['user_record']) {
            return [
                'success' => false,
                "message" => "If email found. Secure token will send to your email."
            ];
        }

        $plain_token = bin2hex(random_bytes(32));
        $hash_token = password_hash($plain_token, PASSWORD_DEFAULT);

        $this->authModel->saveTokenData($user["user_record"]["id"], $hash_token, $type, self::TTL_SECURE_TOKEN);
        return $this->sendUniversalEmail($email, $plain_token, $type);
    }

    public function signInWithToken($plain_token)
    {
        $hash_token = hash('sha256', $plain_token);
        $user = $this->authModel->autoLoginWithCookie($hash_token);

        if (!$user["success"]) {
            setcookie('remember_me', '', time() - 3600, "/");
            return ['success' => false];
        }

        return [
            "success" => true,
            "userInfo" => [
                'id' => $user["user_record"]['id'],
                'name' => $user["user_record"]['name'],
                'role' => $user['role'],
                'is_email_verified' => $user["user_record"]['is_email_verified']

            ],
            "message" => 'Automatically login successfully.'
        ];
    }

    public function validateTokenStep($email, $plain_token, $type)
    {
        $db_result = $this->authModel->getUserRecord($email);
        $user = $db_result['user_record'];

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found.'
            ];
        }

        $attempts_data = $this->authModel->getAttempts($user['id'], $type);

        if ($attempts_data >= self::MAX_ATTEMPTS) {
            return [
                'success' => false,
                'message' => 'Too many attempts.'
            ];
        }

        $db_token = $this->authModel->getValidToken($user['id'], $type);

        if (!$db_token || !password_verify($plain_token, $db_token['token'])) {
            $this->authModel->incrementAttempts($user['id'], $type);
            return [
                'success' => false,
                'message' => 'Invalid or expired token.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Token verified.'
        ];
    }

    // forgot password logic


    public function verifyEmailLogic($email)
    {
        $result = $this->authModel->verifyEmail($email);
        if ($result) {
            $user_data = $this->authModel->getUserRecord($email);
            $this->authModel->deleteToken($user_data['user_record']['id'], 'EMAIL_VERIFICATION');
            $_SESSION['is_email_verified'] = 1;
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function rememberMeLogic($user_id)
    {
        $plain_token = bin2hex(random_bytes(32));
        $hash_token = hash('sha256', $plain_token);

        $this->authModel->saveTokenData($user_id, $hash_token, 'REMEMBER_ME', self::TTL_REMEMBER_TOKEN);

        // HttpOnly cookie cho bảo mật
        setcookie('remember_me', $plain_token, time() + (7 * 24 * 60 * 60), "/", "", false, true);
    }

    public function createNewPassword($email, $new_password, $type)
    {
        if (strlen($new_password) < 6) {
            return [
                'success' => false,
                'message' => 'Password must be at least 6 characters.'
            ];
        }

        $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
        $result = $this->authModel->updatePassword($email, $hash_password);

        if ($result) {
            $user_data = $this->authModel->getUserRecord($email);
            $this->authModel->deleteToken($user_data['user_record']['id'], $type);

            return [
                'success' => true,
                'message' => 'Password updated successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to update password.'
        ];
    }

    public function revokeToken($cookie_token)
    {
        // Remember me dùng sha256 như đã chốt ở login
        $hash = hash('sha256', $cookie_token);
        $result = $this->authModel->deleteTokenByValue($hash, 'REMEMBER_ME');

        return [
            "success" => $result,
            "message" => $result ? "Logged out from this device." : "Failed to revoke session."
        ];
    }

    public function getUserInfoById($id)
    {
        $result = $this->authModel->getUserById($id);
        return $result['user_record']; // Trả về mảng user hoặc null
    }
}
