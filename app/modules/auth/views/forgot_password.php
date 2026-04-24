<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/auth.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="/restaurant_project/public/js/auth/forgot_password.js" defer></script>
</head>

<body>
    <main class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card shadow-lg">
                        <header class="text-center mb-4">
                            <h2 class="fw-bold">Forgot Password</h2>
                            <p class="text-muted small">Enter your email to receive a secure token</p>
                        </header>

                        <form id="forgotPasswordForm" action="index.php?page=forgot_password" method="POST">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                            </div>
                            <button type="submit" class="btn btn-auth w-100">Send Token</button>
                        </form>

                        <footer class="text-center mt-4">
                            <a href="index.php?page=signin" class="auth-link small text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Back to Sign In
                            </a>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
