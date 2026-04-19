<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Token Page</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/sign_in.css">
    <script src="/restaurant_project/public/js/auth/secure_token.js" defer></script>

</head>

<body>
    <main class="signin-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="signin-card shadow-lg">
                        <header class="signin-header text-center mb-4">
                            <h2 class="fw-bold">Verify Token</h2>
                            <p class="text-muted small mt-3">
                                We sent a secure token to <strong><?= htmlspecialchars($_SESSION['email'] ?? 'your email') ?></strong>
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
                            id="secureTokenForm"
                            action="index.php?page=secure_token"
                            method="POST">
                            <div class="mb-4">
                                <label
                                    for="secureToken"
                                    class="form-label small fw-bold text-center d-block">Enter Secure Token</label>
                                <input
                                    type="text"
                                    name="secure_token"
                                    class="form-control text-center l-spacing-lg"
                                    placeholder="Enter secure token from your email"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">
                                Verify & Continue
                            </button>
                        </form>

                        <footer class="text-center mt-3">
                            <span class="small text-muted">Didn't receive code?
                                <a
                                    href="index.php?page=forgot_password"
                                    class="signin-link fw-bold text-decoration-none">
                                    Resend
                                </a>
                            </span>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
