<?php
require_once ROOT_PATH . '/app/modules/reservation/admin_reservation_controller.php';

$admin_reservation_controller = new AdminReservationController();
$reservations = $admin_reservation_controller->getAllReservationsForAdmin();
?>

<div class="container-fluid">
    <h2 class="mb-4">Reservation Management</h2>
    <table class="table table-striped bg-white shadow-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Branch</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number</th>
                <th>Special requests</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $res): ?>
                <tr>
                    <td><?= $res['id'] ?></td>
                    <td><?= $res['branch_name'] ?></td>
                    <td><?= $res['customer_name'] ?></td>
                    <td><?= $res['customer_phone'] ?></td>
                    <td><?= $res['reservation_date'] ?></td>
                    <td><?= $res['reservation_time'] ?></td>
                    <td><?= $res['guest_count'] ?></td>
                    <td><?= $res['special_requests'] ?? 'No notes' ?></td>
                    <td>
                        <button class="btn btn-sm btn-info text-white">View</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
