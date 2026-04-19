<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email Page</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/sign_in.css">
    <script src="/restaurant_project/public/js/auth/verify_email.js" defer></script>
</head>

<body>
    <main class="signin-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-5">
                    <div class="signin-card shadow-lg">
                        <header class="signin-header text-center mb-4">
                            <h2 class="fw-bold">
                                Verify Your Email
                            </h2>
                            <p class="text-muted small">
                                Your account is not verified yet. Please click the button below to receive a secure token.
                            </p>
                        </header>

                        <?php if (isset($_SESSION['auth_error'])): ?>
                            <div class="mb-3">
                                <div class="alert alert-danger text-center small">
                                    <?= $_SESSION['auth_error'];
                                    unset($_SESSION['auth_error']); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form
                            id="verifyEmailForm"
                            action="index.php?page=verify_email"
                            method="POST">

                            <button type="submit" class="btn btn-primary-custom w-100">
                                Send Verification Code
                            </button>
                        </form>

                        <footer class="text-center mt-3">
                            <a href="index.php" class="signin-link small fw-bold text-decoration-none">
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
