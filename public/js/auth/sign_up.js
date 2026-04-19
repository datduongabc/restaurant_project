$(function () {
  const $signupForm = $("#signupForm");

  if ($signupForm.length) {
    $signupForm.on("submit", handleSignupSubmit);
  }
});

function handleSignupSubmit(event) {
  const $phone = $("#phone");
  const phoneInput = $phone.val().trim();
  const $password = $("#password");
  const passwordInput = $password.val();

  // Client validation
  const phoneRegex = /^[0-9]{10}$/;
  if (!phoneRegex.test(phoneInput)) {
    event.preventDefault();
    $phone.focus();
    return;
  }

  if (passwordInput.length < 6) {
    event.preventDefault();
    $password.focus();
    return;
  }
}
