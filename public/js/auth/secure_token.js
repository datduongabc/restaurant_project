$(function () {
  const $form = $("#secureTokenForm");
  if ($form.length) {
    $form.on("submit", handleSecureTokenSubmit);
  }
});

function handleSecureTokenSubmit(event) {
  const $token = $("#secureToken");
  const tokenVal = $token.val().trim();
  const $btn = $(this).find('button[type="submit"]');

  if (tokenVal.length !== 64) {
    event.preventDefault();
    alert("Invalid token length. Please check your email again.");
    $token.focus();
    return false;
  }

  showLoading($btn, "Verifying...");
}

function showLoading($btn, text) {
  $btn
    .prop("disabled", true)
    .html(`<span class="spinner-border spinner-border-sm me-2"></span>${text}`);
}
