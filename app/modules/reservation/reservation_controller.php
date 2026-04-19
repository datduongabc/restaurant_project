<?php
require_once ROOT_PATH . '/app/modules/reservation/reservation_service.php';

class ReservationController
{
    private $reservationService;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
    }

    public function createReservation()
    {
        // Handle POST requests from reservation form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'] ?? null;
            $result = $this->reservationService->createReservation($_POST, $user_id);

            if ($result['success']) {
                $_SESSION['reservation_success'] = $result['message'];
            } else {
                $_SESSION['reservation_error'] = $result['message'];
            }

            header("Location: index.php");
            exit();
        }
    }
}
