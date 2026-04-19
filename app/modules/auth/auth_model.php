<?php

require_once ROOT_PATH . '/app/core/Database.php';


class AuthModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // sign up
    public function checkDuplicateInfo($email, $phone)
    {
        try {
            $stmt = $this->db->prepare("SELECT email, phone FROM users WHERE (email = ? OR phone = ?) AND deleted_at IS NULL LIMIT 1");
            $stmt->execute([$email, $phone]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function createNewUser($name, $email, $password, $phone)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `users` (name, email, password, phone) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$name, $email, $password, $phone]);
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function getUserRecord($email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND deleted_at IS NULL LIMIT 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            return [
                "success" => true,
                "user_record" => $user ? $user : null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function autoLoginWithCookie($hash_token)
    {
        try {
            $stmt = $this->db->prepare(
                "SELECT u.* FROM users u
                JOIN password_resets pr ON u.id = pr.user_id
                WHERE pr.token = ? AND pr.type = 'REMEMBER_ME' AND pr.expired_at > NOW()
                LIMIT 1"
            );
            $stmt->execute([$hash_token]);
            return [
                "success" => true,
                "user_record" => $stmt->fetch()
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function saveTokenData($user_id, $hash, $type, $expired_at)
    {
        $this->deleteToken($user_id, $type);
        $stmt = $this->db->prepare("INSERT INTO password_resets(user_id, token, type, expired_at) VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE))");
        return [
            "success" => $stmt->execute([$user_id, $hash, $type, $expired_at]),
            "message" => "Save secure token successfully."
        ];
    }

    public function getValidToken($user_id, $type)
    {
        $stmt = $this->db->prepare("SELECT token FROM password_resets WHERE user_id = ? AND type = ? AND expired_at > NOW() LIMIT 1");
        $stmt->execute([$user_id, $type]);
        return $stmt->fetch();
    }

    public function getAttempts($user_id, $type)
    {
        $stmt = $this->db->prepare("SELECT attempts FROM password_resets WHERE user_id = ? AND type = ?");
        $stmt->execute([$user_id, $type]);
        $result = $stmt->fetch();
        return $result ? (int)$result['attempts'] : 0;
    }

    public function incrementAttempts($user_id, $type)
    {
        $stmt = $this->db->prepare("UPDATE password_resets SET attempts = attempts + 1 WHERE user_id = ? AND type = ?");
        return $stmt->execute([$user_id, $type]);
    }

    public function updatePassword($email, $hash_password)
    {
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE email = ?");
        return $stmt->execute([$hash_password, $email]);
    }

    public function verifyEmail($email)
    {

        $stmt = $this->db->prepare("UPDATE users SET is_email_verified = 1, email_verified_at = NOW() WHERE email = ?");
        return $stmt->execute([$email]);
    }

    public function deleteToken($user_id, $type)
    {
        $stmt = $this->db->prepare("DELETE FROM password_resets WHERE user_id = ? AND type = ?");
        return $stmt->execute([$user_id, $type]);
    }

    public function deleteTokenByValue($hash, $type)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM password_resets WHERE token = ? AND type = ?");
            return $stmt->execute([$hash, $type]);
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getUserById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? AND deleted_at IS NULL LIMIT 1");
            $stmt->execute([$id]);
            $user = $stmt->fetch();
            return [
                "success" => true,
                "user_record" => $user ? $user : null
            ];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
