<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="/restaurant_project/public/css/auth/sign_up.css">
    <script src="/restaurant_project/public/js/auth/sign_up.js" defer></script>
</head>

<body>
    <main class="signup-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="signup-card shadow-lg">
                        <header class="card-header-custom text-center">
                            <h2 class="fw-bold">Create Account</h2>
                            <p>Join our restaurant community today</p>
                        </header>

                        <form
                            id="signupForm"
                            action=" index.php?page=signup"
                            method="POST"
                            class="signup-form">

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

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input
                                    id="fullName"
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Name"
                                    required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email"
                                    required>
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input
                                    id="phone"
                                    type="tel"
                                    name="phone"
                                    class="form-control"
                                    minlength="10"
                                    placeholder="Phone number"
                                    required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password class=" form-label">Password</label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="••••••••"
                                    minlength="8"
                                    required>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit" class="btn btn-signup w-100 mb-3">Create an account
                            </button>
                        </form>

                        <footer class="card-footer-custom text-center">
                            <span class="small text-muted">Already have an account?
                                <a
                                    href="index.php?page=signin"
                                    class="signin-link fw-bold">
                                    Sign In
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
