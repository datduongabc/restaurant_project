$(function () {
  const $secureTokenForm = $("#secureTokenForm");

  if ($secureTokenForm.length) {
    $secureTokenForm.on("submit", handleSecureTokenSubmit);
  }
});

function handleSecureTokenSubmit(event) {
  const $token = $("#secureToken");
  const tokenVal = $token.val().trim();
  const $submitBtn = $(this).find('button[type="submit"]');

  // Client validation
  if (tokenVal.length < 10) {
    event.preventDefault();
    alert("Invalid token format. Token must be longer.");
    $token.focus();
    return;
  }

  // Lock button preventing spamming
  if ($submitBtn.length) {
    $submitBtn.css("width", $submitBtn.outerWidth() + "px");
    $submitBtn.prop("disabled", true);
    $submitBtn.html(
      '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Verifying...',
    );
  }
}
