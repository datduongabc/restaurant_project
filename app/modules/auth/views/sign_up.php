<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/auth.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="/restaurant_project/public/js/auth/sign_up.js" defer></script>
</head>

<body>
    <main class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="auth-card shadow-lg">
                        <header class="text-center mb-4">
                            <h2 class="fw-bold">Create Account</h2>
                            <p class="text-muted small">Join our restaurant community today</p>
                        </header>

                        <?php if (isset($_SESSION['auth_success']) || isset($_SESSION['auth_error'])): ?>
                            <div class="mb-3">
                                <div class="alert alert-<?= isset($_SESSION['auth_success']) ? 'success' : 'danger' ?> text-center small py-2">
                                    <?= $_SESSION['auth_success'] ?? $_SESSION['auth_error'] ?>
                                    <?php unset($_SESSION['auth_success'], $_SESSION['auth_error']); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form id="signupForm" action="index.php?page=signup" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input id="fullName" type="text" name="name" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input id="phone" type="tel" name="phone" class="form-control" placeholder="0123456789" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="password-field">
                                    <input id="password" type="password" name="password" class="form-control" placeholder="••••••••" minlength="8" required>
                                    <i class="fa-solid fa-eye toggle-password" id="togglePasswordIcon"></i>
                                </div>
                                <div class="form-text small">Must be at least 8 characters.</div>
                            </div>

                            <button type="submit" class="btn btn-auth w-100">Create Account</button>
                        </form>

                        <footer class="text-center mt-4">
                            <span class="small text-muted">Already have an account?
                                <a href="index.php?page=signin" class="auth-link">Sign In</a>
                            </span>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
