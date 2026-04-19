<!-- Reservation -->
<section class="py-5" id="reservation">
    <div class="container">
        <div class="card hover-card shadow-lg border-0 rounded-4 p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-teal-dark">Book a Table</h2>
            </div>

            <?php if (isset($_SESSION['reservation_success'])): ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['reservation_success'];
                    unset($_SESSION['reservation_success']);
                    ?>
                </div>
            <?php elseif (isset($_SESSION['reservation_error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['reservation_error'];
                    unset($_SESSION['reservation_error']); ?>
                </div>
            <?php endif; ?>

            <form
                id="reservationForm"
                action="index.php?page=main"
                method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="fullName" class="form-label fw-semibold">Full name</label>
                        <input
                            type="text"
                            class="form-control bg-light"
                            id="fullName"
                            name="customer_name"
                            placeholder="Enter your full name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">Phone Number</label>
                        <input
                            type="tel"
                            class="form-control bg-light"
                            id="phone"
                            name="customer_phone"
                            placeholder="0123 456 789"
                            minlength="10"
                            maxlength="10"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="bookingDate" class="form-label fw-semibold">Booking Date</label>
                        <input
                            type="date"
                            class="form-control bg-light"
                            id="bookingDate"
                            name="reservation_date"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="arrivalTime" class="form-label fw-semibold">Arrival Time</label>
                        <input
                            type="time"
                            class="form-control bg-light"
                            id="arrivalTime"
                            name="reservation_time"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="bookingBranch" class="form-label fw-semibold">Branch Location</label>
                        <select id="bookingBranch" class="form-select bg-light" name="location_id" required>
                            <option value="" disabled selected>Select a branch</option>
                            <option value="1">Ascent Restaurant - District 1</option>
                            <option value="2">Ascent Restaurant - District 7</option>
                            <option value="3">Ascent Restaurant - Thu Duc</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="guests" class="form-label fw-semibold">Number of People</label>
                        <select class="form-select bg-light" id="guests" name="guest_count" required>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> <?= $i === 1 ? 'person' : 'people' ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="bookingNotes" class="form-label fw-semibold">Special Requests</label>
                        <textarea
                            id="bookingNotes"
                            class="form-control bg-light border-0"
                            name="special_requests"
                            rows="3"
                            placeholder="Notes..."></textarea>
                    </div>
                    <div class="col-12 mt-4 text-center">
                        <button type="submit" class="btn btn-custom-teal btn-lg">Confirm Reservation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
