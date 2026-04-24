$(function () {
  const $form = $("#forgotPasswordForm");
  if ($form.length) {
    $form.on("submit", handleForgotPasswordSubmit);
  }
});

function handleForgotPasswordSubmit(event) {
  const $email = $("#email");
  const emailVal = $email.val().trim();
  const $btn = $(this).find('button[type="submit"]');

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailVal)) {
    event.preventDefault();
    alert("Please enter a valid email address.");
    $email.focus();
    return false;
  }

  showLoading($btn, "Sending...");
}

function showLoading($btn, text) {
  $btn
    .prop("disabled", true)
    .html(`<span class="spinner-border spinner-border-sm me-2"></span>${text}`);
}
