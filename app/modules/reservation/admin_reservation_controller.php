<?php
require_once ROOT_PATH . '/app/modules/reservation/reservation_service.php';

class AdminReservationController
{
    private $reservationService;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
    }
    public function getAllReservationsForAdmin()
    {
        return $this->reservationService->getReservationForAdmin();
    }
}
