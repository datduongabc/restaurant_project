<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Page</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/sign_in.css">
    <script src="/restaurant_project/public/js/auth/reset_password.js" defer></script>
</head>

<body>
    <main class="signin-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="signin-card shadow-lg">
                        <header class="signin-header text-center mb-4">
                            <h2 class="fw-bold">New Password</h2>
                            <p class="text-muted small">
                                Set a strong new password for your account
                            </p>
                        </header>

                        <div class="mb-3">
                            <?php if (isset($_SESSION['auth_error'])): ?>
                                <div class="alert alert-danger text-center">
                                    <?= $_SESSION['auth_error'];
                                    unset($_SESSION['auth_error']); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <form
                            id="resetPasswordForm"
                            action="index.php?page=reset_password"
                            method="POST">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label small fw-bold">New Password</label>
                                <input
                                    id="newPassword"
                                    type="password"
                                    name="new_password"
                                    class="form-control"
                                    placeholder="••••••••"
                                    minlength="8"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label small fw-bold">Confirm New Password</label>
                                <input
                                    id="confirmPassword"
                                    type="password"
                                    name="confirm_password"
                                    class="form-control"
                                    placeholder="••••••••"
                                    minlength="8"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
