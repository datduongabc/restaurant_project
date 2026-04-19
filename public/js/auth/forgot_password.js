$(function () {
  const $forgotPasswordForm = $("#forgotPasswordForm");

  if ($forgotPasswordForm.length) {
    $forgotPasswordForm.on("submit", handleForgotPasswordSubmit);
  }
});

function handleForgotPasswordSubmit(event) {
  const $email = $("#email");
  const emailVal = $email.val().trim();
  const $submitBtn = $(this).find('button[type="submit"]');

  // Client validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailVal)) {
    event.preventDefault();
    alert("Please enter a valid email address.");
    $email.focus();
    return;
  }

  // Lock button preventing spamming
  if ($submitBtn.length) {
    $submitBtn.css("width", $submitBtn.outerWidth() + "px");
    $submitBtn.prop("disabled", true);
    $submitBtn.html(
      '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...',
    );
  }
}
