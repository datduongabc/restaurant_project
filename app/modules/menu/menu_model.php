<?php

require_once ROOT_PATH . '/app/core/Database.php';

class MenuDetailModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getProductBySlug($slug)
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, c.name AS category_name, c.slug AS category_slug
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.slug = :slug AND p.deleted_at is NULL
            LIMIT 1"
        );
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }
}
