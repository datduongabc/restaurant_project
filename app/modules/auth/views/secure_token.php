<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Token Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/auth.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="/restaurant_project/public/js/auth/secure_token.js" defer></script>

</head>

<body>
    <main class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card shadow-lg">
                        <header class="text-center mb-4">
                            <h2 class="fw-bold">Verify Token</h2>
                            <p class="text-muted small">
                                Token sent to: <strong><?= htmlspecialchars($_SESSION['email'] ?? 'your email') ?></strong>
                            </p>
                        </header>

                        <?php if (isset($_SESSION['auth_error'])): ?>
                            <div class="alert alert-danger text-center small py-2 mb-3">
                                <?= $_SESSION['auth_error'];
                                unset($_SESSION['auth_error']); ?>
                            </div>
                        <?php endif; ?>

                        <form id="secureTokenForm" action="index.php?page=secure_token" method="POST">
                            <div class="mb-4">
                                <label for="secureToken" class="form-label d-block text-center">Enter Secure Token</label>
                                <input id="secureToken" type="text" name="secure_token" class="form-control text-center" placeholder="Paste token here" required>
                            </div>
                            <button type="submit" class="btn btn-auth w-100">Verify & Continue</button>
                        </form>

                        <footer class="text-center mt-4">
                            <span class="small text-muted">Didn't receive code?
                                <a href="index.php?page=forgot_password" class="auth-link">Resend</a>
                            </span>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
