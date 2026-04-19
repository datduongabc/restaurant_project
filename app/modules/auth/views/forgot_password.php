<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Page</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/sign_in.css">
    <script src="/restaurant_project/public/js/auth/forgot_password.js" defer></script>
</head>

<body>
    <main class="signin-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="signin-card shadow-lg">
                        <header class="signin-header text-center mb-4">
                            <h2 class="fw-bold">Forgot Password</h2>
                            <p class="text-muted small">
                                Enter your email to receive a secure token
                            </p>
                        </header>

                        <form
                            id="forgotPasswordForm"
                            action="index.php?page=forgot_password"
                            method="POST">
                            <div class="mb-4">
                                <label for="email" class="form-label small fw-bold">Email Address</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">
                                Submit
                            </button>
                        </form>

                        <footer class="text-center mt-3">
                            <a
                                href="index.php?page=signin"
                                class="signin-link small fw-bold text-decoration-none">
                                <i class="bi bi-arrow-left"></i>
                                Back to Sign In
                            </a>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
