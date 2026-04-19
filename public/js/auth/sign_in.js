/* 3. Main functions */
$(function () {
  const $signinForm = $("#signinForm");

  if ($signinForm.length) {
    $signinForm.on("submit", handleSigninSubmit);
  }
});

/* 4. Helper functions */
function handleSigninSubmit(event) {
  const $password = $("#password");
  const passwordInput = $password.val();
  const $submitBtn = $(this).find('button[type="submit"]');

  // Client validation
  if (passwordInput.length < 6) {
    event.preventDefault();
    alert("Password must be at least 6 characters long.");
    $password.focus();
    return;
  }
}
