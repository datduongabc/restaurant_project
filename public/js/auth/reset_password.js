$(function () {
  const $form = $("#resetPasswordForm");
  if ($form.length) {
    $form.on("submit", handleResetPasswordSubmit);
  }
});

function handleResetPasswordSubmit(event) {
  const $newPass = $("#newPassword");
  const $btn = $(this).find('button[type="submit"]');

  if ($newPass.val().length < 8) {
    event.preventDefault();
    alert("Password must be at least 8 characters long.");
    $newPass.focus();
    return false;
  }

  showLoading($btn, "Updating...");
}

function showLoading($btn, text) {
  $btn
    .prop("disabled", true)
    .html(`<span class="spinner-border spinner-border-sm me-2"></span>${text}`);
}
