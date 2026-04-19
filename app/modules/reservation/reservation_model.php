<?php

require_once ROOT_PATH . '/app/core/Database.php';

class ReservationModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createReservation($user_id, $location_id, $customer_name, $customer_phone, $reservation_date, $reservation_time, $guest_count, $special_requests)
    {
        try {
            $stmt = $this->db->prepare(
                "
                INSERT INTO reservations (user_id, location_id, customer_name, customer_phone, reservation_date, reservation_time, guest_count, special_requests)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            return $stmt->execute([$user_id, $location_id, $customer_name, $customer_phone, $reservation_date, $reservation_time, $guest_count, $special_requests]);
        } catch (PDOException $e) {
            return [
                "succes" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function getReservationsForAdmin()
    {
        try {
            $sql =
                "SELECT r.*, l.address AS branch_name
                FROM reservations r
                LEFT JOIN locations l ON r.location_id = l.id
                ORDER BY r.reservation_date DESC, r.reservation_time DESC";

            return $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            return [
                "succes" => false,
                "message" => $e->getMessage()
            ];
        }
    }
}
