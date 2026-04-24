$(function () {
  const $verifyForm = $("#verifyEmailForm");

  if ($verifyForm.length) {
    $verifyForm.on("submit", handleVerifySubmit);
  }
});

function handleVerifySubmit(event) {
  const $submitBtn = $(this).find('button[type="submit"]');
  showLoading($submitBtn, "Sending Email...");
}

function showLoading($btn, text) {
  if ($btn.length) {
    $btn.css("width", $btn.outerWidth() + "px");
    $btn.prop("disabled", true);
    $btn.html(
      `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>${text}`,
    );
  }
}
