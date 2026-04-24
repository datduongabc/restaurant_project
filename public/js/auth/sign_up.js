$(function () {
  const $signupForm = $("#signupForm");
  const $toggleIcon = $("#togglePasswordIcon");

  if ($signupForm.length) {
    $signupForm.on("submit", handleSignupSubmit);
  }

  if ($toggleIcon.length) {
    $toggleIcon.on("click", togglePasswordVisibility);
  }
});

function handleSignupSubmit(event) {
  const $phone = $("#phone");
  const $password = $("#password");

  const phoneInput = $phone.val().trim();
  const passwordInput = $password.val();

  const phoneRegex = /^[0-9]{10}$/;
  if (!phoneRegex.test(phoneInput)) {
    event.preventDefault();
    alert("Phone number is invalid. Must have exactly 10 digits.");
    $phone.focus();
    return false;
  }

  if (passwordInput.length < 8) {
    event.preventDefault();
    alert("The password must contain at least 8 characters.");
    $password.focus();
    return false;
  }
}

function togglePasswordVisibility() {
  const $passwordInput = $("#password");
  const isPassword = $passwordInput.attr("type") === "password";
  $passwordInput.attr("type", isPassword ? "text" : "password");
  $(this).toggleClass("fa-eye fa-eye-slash");
}
