<?php

require_once ROOT_PATH . '/app/core/Database.php';

class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getFeatured()
    {
        $sql = "SELECT p.*, c.slug AS category_slug
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.deleted_at IS NULL
                ORDER BY p.average_rating DESC
                LIMIT 1";
        return $this->db->query($sql)->fetch();
    }

    // for displaying menu lists on the screen
    public function getProducts($limit, $offset, $sort)
    {
        $sql = "SELECT p.*, c.slug AS category_slug,
                GROUP_CONCAT(l.address SEPARATOR ', ') AS location_address, -- 1 product can be appeared in many branches
                GROUP_CONCAT(l.url SEPARATOR ', ') AS location_link
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN product_availabilities pa ON p.id = pa.product_id
                LEFT JOIN locations l ON pa.location_id = l.id
                WHERE p.deleted_at IS NULL";

        // Sort theo category
        if ($sort === "starters" || $sort === "main_dishes") {
            $sql .= " AND c.slug = :category_slug";
        }

        // Because use left join so it can be 2 or more than the same product in result
        $sql .= " GROUP BY p.id";

        // Sort theo price and rating
        switch ($sort) {
            case 'price_asc':
                $sql .= " ORDER BY p.price ASC, p.id ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY p.price DESC, p.id ASC";
                break;
            case 'rating_asc':
                $sql .= " ORDER BY p.average_rating ASC, p.id ASC";
                break;
            case 'rating_desc':
                $sql .= " ORDER BY p.average_rating DESC, p.id ASC";
                break;
            default:
                $sql .= " ORDER BY p.id ASC";
                break;
        }

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        // Bind value
        if ($sort === "starters" || $sort === "main_dishes") {
            $stmt->bindValue(':category_slug', $sort, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // For admin and pagination
    public function countProducts($sort)
    {
        $sql = "SELECT COUNT(p.id) FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.deleted_at IS NULL";

        if ($sort === "starters" || $sort === "main_dishes") {
            $sql .= " AND c.slug = :category_slug";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':category_slug', $sort, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            $stmt = $this->db->query($sql);
        }

        return (int)$stmt->fetchColumn();
    }

    // For admin
    public function getAllProductsForAdmin()
    {
        $sql = "SELECT * FROM products ORDER BY id ASC";
        return $this->db->query($sql)->fetchAll();
    }
}
