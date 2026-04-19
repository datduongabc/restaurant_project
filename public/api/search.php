<?php
header('Content-Type: application/json');

try {
    $db = Database::getInstance()->getConnection();

    $query = isset($_GET['query']) ? trim($_GET['query']) : '';

    if (strlen($query) > 0) {
        $sql = "SELECT p.*, c.slug AS category_slug
                FROM products AS p
                JOIN categories AS c ON p.category_id = c.id
                WHERE p.name LIKE :search AND p.deleted_at is NULL
                LIMIT 3";

        $stmt = $db->prepare($sql);
        $stmt->execute(['search' => '%' . $query . '%']);
        $results = $stmt->fetchAll();

        echo json_encode($results);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed']);
}
