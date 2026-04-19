<?php

require_once ROOT_PATH . '/app/modules/reservation/reservation_model.php';

class ReservationService
{
    private $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
    }

    public function createReservation($data, $user_id = null)
    {
        $customer_name = trim($data['customer_name'] ?? '');
        $customer_phone = $data['customer_phone'] ?? '';
        $reservation_date = $data['reservation_date'] ?? '';
        $reservation_time = $data['reservation_time'] ?? '';
        $location_id = (int)$data['location_id'] ?? 0;
        $guest_count = (int)$data['guest_count'] ?? 0;
        $special_requests = htmlspecialchars($data['special_requests'] ?? '');

        if (empty($customer_name) || empty($customer_phone) || empty($reservation_date) || empty($reservation_time) || empty($guest_count) || empty($location_id)) {
            return [
                'success' => false,
                'message' => 'Please fill in all required fields.'
            ];
        }

        if ($location_id === 0) {
            return [
                'success' => false,
                'message' => 'Invalid branch selection.'
            ];
        }
        if ($guest_count === 0) {
            return [
                'success' => false,
                'message' => 'Invalid number of <guests></guests> selection.'
            ];
        }

        if (strlen($customer_phone) !== 10 || !ctype_digit($customer_phone)) {
            return [
                'success' => false,
                'message' => 'Invalid phone number.'
            ];
        }

        $today = date('Y-m-d');
        $reservation_date = date('Y-m-d', strtotime($reservation_date));
        // Can not select past date
        if ($reservation_date < $today) {
            return [
                'success' => false,
                'message' => 'Reservation date cannot be in the past.'
            ];
        }

        // Only allow reservations up to 10 days in advance
        $max_date = date('Y-m-d', strtotime('+10 days'));
        if ($reservation_date > $max_date) {
            return [
                'success' => false,
                'message' => 'Reservations can only be made up to 10 days in advance.'
            ];
        }

        $reservation_time = date('H:i:s', strtotime($reservation_time));

        $status = $this->reservationModel->createReservation($user_id, $location_id, $customer_name, $customer_phone, $reservation_date, $reservation_time, $guest_count, $special_requests);

        if (!$status) {
            return [
                'success' => false,
                'message' => "Something error happened."
            ];
        } else {
            return [
                'success' => true,
                'message' => "Reservation successfully."
            ];
        }
    }

    public function getReservationForAdmin()
    {
        return  $this->reservationModel->getReservationsForAdmin();
    }
}
