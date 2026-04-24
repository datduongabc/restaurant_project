<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/auth.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="/restaurant_project/public/js/auth/verify_email.js" defer></script>
</head>

<body>
    <main class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card shadow-lg">
                        <header class="text-center mb-4">
                            <h2 class="fw-bold">Verify Your Email</h2>
                            <p class="text-muted small">
                                Your account is not verified yet. Please click the button below to receive a secure token via email.
                            </p>
                        </header>

                        <?php if (isset($_SESSION['auth_error'])): ?>
                            <div class="mb-3">
                                <div class="alert alert-danger text-center small py-2">
                                    <?= htmlspecialchars($_SESSION['auth_error']); ?>
                                    <?php unset($_SESSION['auth_error']); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form id="verifyEmailForm" action="index.php?page=verify_email" method="POST">
                            <button type="submit" class="btn btn-auth w-100">
                                Send Verification Code
                            </button>
                        </form>

                        <footer class="text-center mt-4">
                            <a href="index.php" class="auth-link small text-decoration-none fw-bold">
                                <i class="bi bi-arrow-left"></i> Back to Home
                            </a>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
