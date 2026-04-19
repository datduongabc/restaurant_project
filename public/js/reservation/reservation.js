$(function () {
  const $reservationForm = $("#reservationForm");

  if ($reservationForm.length) {
    $reservationForm.on("submit", handleReservationSubmit);
  }
});

function handleReservationSubmit(event) {
  const $phone = $("#phone");
  const $date = $("#bookingDate");
  const $submitBtn = $(this).find('button[type="submit"]');

  // Client validation 1
  const phoneRegex = /^[0-9]{10}$/;
  if (!phoneRegex.test($phone.val().trim())) {
    event.preventDefault();
    alert("Phone number must be exactly 10 digits.");
    $phone.focus();
    return;
  }

  const selectedDate = new Date($date.val());
  const today = new Date();
  today.setHours(0, 0, 0, 0);

  if (selectedDate < today) {
    event.preventDefault();
    alert("Reservation date cannot be in the past.");
    $date.focus();
    return;
  }

  // Lock button preventing spamming
  if ($submitBtn.length) {
    $submitBtn.css("width", $submitBtn.outerWidth() + "px");
    $submitBtn.prop("disabled", true);
    $submitBtn.html(
      '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Confirming...',
    );
  }
}
