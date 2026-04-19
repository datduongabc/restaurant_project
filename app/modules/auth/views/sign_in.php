<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/sign_in.css">
    <script src="/restaurant_project/public/js/auth/sign_in.js" defer></script>
</head>

<body>
    <main class="signin-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="signin-card shadow-lg">
                        <header class="signin-header text-center">
                            <h2 class="fw-bold">Welcome Back</h2>
                            <p class="text-muted small">Please enter your details to sign in</p>
                        </header>

                        <form
                            id="signinForm"
                            action="index.php?page=signin"
                            method="POST">

                            <div class="mb-3">
                                <?php if (isset($_SESSION['auth_success'])): ?>
                                    <div class="alert alert-success text-center">
                                        <?= $_SESSION['auth_success'];
                                        unset($_SESSION['auth_success']); ?>
                                    </div>
                                <?php elseif (isset($_SESSION['auth_error'])): ?>
                                    <div class="alert alert-danger text-center">
                                        <?= $_SESSION['auth_error'];
                                        unset($_SESSION['auth_error']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-bold">
                                    Email Address
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email"
                                    required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <div for="password" class="d-flex justify-content-between">
                                    <label class="form-label small fw-bold">
                                        Password
                                    </label>
                                    <a
                                        href="index.php?page=forgot_password"
                                        class="signin-link small">
                                        Forgot password?
                                    </a>
                                </div>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="••••••••"
                                    minlength="8"
                                    required>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input
                                    id="remember"
                                    type="checkbox"
                                    name="remember"
                                    class="form-check-input">
                                <label
                                    for="remember" class="form-check-label small">Remember me
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit" class="btn btn-primary-custom w-100">Sign In
                            </button>
                        </form>

                        <footer class="text-center mt-3">
                            <span class="small text-muted">Don't have an account?
                                <a
                                    href="index.php?page=signup"
                                    class="signin-link fw-bold">
                                    Sign Up
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
