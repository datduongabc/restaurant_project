<header>
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="?page=home">
                <span class="text-primary-orange">DaT</span><span class="text-teal-dark">eNO</span>
            </a>

            <button
                class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-2 align-items-center fw-semibold">
                    <li class="nav-item"><a class="nav-link" href="?page=home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=home#menu-list">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=home#feedback">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=home#reservation">Contact</a></li>
                </ul>

                <div class="search-wrapper flex-grow-1 position-relative mx-lg-3 my-lg-auto mx-lg-5">
                    <i class="bi bi-search position-absolute text-muted" style="top: 50%; transform: translateY(-50%); left: 15px;"></i>
                    <input
                        id="ajaxSearch"
                        class="form-control rounded-pill ps-5"
                        type="search"
                        placeholder="Search food ..."
                        autocomplete="off">
                    <div id="searchResults" class="search-results-dropdown shadow-lg rounded-3 d-none">
                    </div>
                </div>

                <div class="navbar-nav flex-row justify-content-center align-items-center gap-2 gap-xl-4 mt-3 mt-lg-0">
                    <div class="nav-item">
                        <a class="nav-link position-relative p-0 mt-1" href="?page=cart" aria-label="View Cart">
                            <i class="bi bi-cart3 fs-4 text-teal-dark"></i>
                        </a>
                    </div>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle pe-2 fs-4 text-teal-dark"></i>
                                <span class="d-none d-lg-inline">
                                    <?= htmlspecialchars($_SESSION['name']); ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 mt-3">
                                <?php if (!$_SESSION['is_email_verified']): ?>
                                    <li>
                                        <a
                                            class="dropdown-item text-warning fw-bold"
                                            href="index.php?page=verify_email">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Verify Account
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?page=change_password">
                                        <i class="bi bi-shield-lock me-1"></i> Change password
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?page=orders">
                                        <i class="bi bi-bag me-1"></i> Orders
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="index.php?page=signout">
                                        <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="nav-item">
                            <a href="index.php?page=signin" class="btn btn-custom-primary rounded-pill px-4">
                                Login
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
