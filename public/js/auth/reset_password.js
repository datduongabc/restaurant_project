$(function () {
  const $resetPasswordForm = $("#resetPasswordForm");

  if ($resetPasswordForm.length) {
    $resetPasswordForm.on("submit", handleResetPasswordSubmit);
  }
});

function handleResetPasswordSubmit(event) {
  const $newPass = $("#newPassword");
  const $confirmPass = $("#confirmPassword");
  const $submitBtn = $(this).find('button[type="submit"]');

  // Client validation
  if ($newPass.val().length < 6) {
    event.preventDefault();
    alert("Password must be at least 6 characters long.");
    $newPass.focus();
    return;
  }

  if ($newPass.val() !== $confirmPass.val()) {
    event.preventDefault();
    alert("Passwords do not match. Please try again.");
    $confirmPass.val("");
    $confirmPass.focus();
    return;
  }

  // Lock button preventing spamming
  if ($submitBtn.length) {
    $submitBtn.css("width", $submitBtn.outerWidth() + "px");
    $submitBtn.prop("disabled", true);
    $submitBtn.html(
      '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Updating...',
    );
  }
}
