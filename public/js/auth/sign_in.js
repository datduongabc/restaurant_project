$(function () {
  const $signinForm = $("#signinForm");
  const $toggleIcon = $("#togglePasswordIcon");

  // Event Bindings
  if ($signinForm.length) {
    $signinForm.on("submit", handleSigninSubmit);
  }

  if ($toggleIcon.length) {
    $toggleIcon.on("click", togglePasswordVisibility);
  }
});

function handleSigninSubmit(event) {
  const $password = $("#password");
  const passwordInput = $password.val();

  if (passwordInput.length < 8) {
    event.preventDefault();
    alert("Password must be at least 8 characters long.");
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
