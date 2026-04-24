<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/auth.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="/restaurant_project/public/js/auth/sign_in.js" defer></script>
</head>

<body>
    <main class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card shadow-lg">
                        <header class="text-center mb-4">
                            <h2 class="fw-bold">Welcome Back</h2>
                            <p class="text-muted small">Please enter your details to sign in</p>
                        </header>

                        <?php if (isset($_SESSION['auth_success']) || isset($_SESSION['auth_error'])): ?>
                            <div class="mb-3">
                                <div class="alert alert-<?= isset($_SESSION['auth_success']) ? 'success' : 'danger' ?> text-center small py-2">
                                    <?= $_SESSION['auth_success'] ?? $_SESSION['auth_error'] ?>
                                    <?php unset($_SESSION['auth_success'], $_SESSION['auth_error']); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form id="signinForm" action="index.php?page=signin" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password" class="form-label mb-0">Password</label>
                                    <a href="index.php?page=forgot_password" class="auth-link small">Forgot password?</a>
                                </div>
                                <div class="password-field">
                                    <input id="password" type="password" name="password" class="form-control" placeholder="••••••••" minlength="8" required>
                                    <i class="fa-solid fa-eye toggle-password" id="togglePasswordIcon"></i>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input id="remember" type="checkbox" name="remember" class="form-check-input">
                                <label for="remember" class="form-check-label small text-muted">Remember me for 7 days</label>
                            </div>

                            <button type="submit" class="btn btn-auth w-100">Sign In</button>
                        </form>

                        <footer class="text-center mt-4">
                            <span class="small text-muted">Don't have an account?
                                <a href="index.php?page=signup" class="auth-link">Sign Up</a>
                            </span>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
