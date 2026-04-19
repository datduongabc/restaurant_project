$(function () {
  const $verifyForm = $("#verifyEmailForm");

  if ($verifyForm.length) {
    $verifyForm.on("submit", handleVerifySubmit);
  }
});

function handleVerifySubmit(event) {
  // Client validation

  // UX: Lock submit button preventing spamming
  const $submitBtn = $(this).find('button[type="submit"]');

  if ($submitBtn.length) {
    // Giữ nguyên chiều rộng nút để tránh bị giật giao diện
    $submitBtn.css("width", $submitBtn.outerWidth() + "px");
    $submitBtn.prop("disabled", true);

    $submitBtn.html(
      '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending Email...',
    );
  }
}
