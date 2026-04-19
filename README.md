# 🍽️ Food Ordering Restaurant - Management & Ordering System

## 📖 Introduction

**DaTeNO** is a comprehensive, full-stack web application designed for restaurant management and food ordering. Built from scratch using a custom **PHP MVC Architecture**, this project demonstrates strong backend fundamentals, secure authentication flows, and seamless frontend interactions using AJAX.

## ✨ Key Features

### 🔐 Secure Authentication & User Management

- **Advanced Login/Registration:** Includes robust server-side validation and password hashing (`password_hash`).
- **Email Verification:** Users must verify their email via a secure, time-limited token sent via **PHPMailer**.
- **Password Recovery:** Secure "Forgot Password" and "Change Password" workflows utilizing OTP tokens to prevent unauthorized access and Replay Attacks.
- **"Remember Me" Functionality:** Implemented using securely hashed HTTP-only cookies and database-backed tokens.

### 🍔 Interactive Menu & Ordering

- **Dynamic Menu Grid:** Products are loaded from a normalized MySQL database.
- **AJAX Pagination & Sorting:** Users can filter (Price, Rating, Category) and navigate through menu pages smoothly without reloading the browser.
- **Smart UI/UX:** Features a "Tie-breaker" sorting algorithm in SQL to ensure stable pagination.

### 📅 Table Reservation System

- **Real-time Validation:** Clients can easily book a table at specific branches with date/time validation to prevent past-date bookings.
- **Anti-Spam:** Integrated UI loading states and button-disabling mechanisms during form submission.

### 🛡️ Admin Dashboard (Role-Based Access Control)

- Authorized administrators can access secure routes to manage Products, Users, and Reservations efficiently.

---

## 🛠️ Tech Stack

**Backend:**

- Core PHP 8.x (Custom MVC Architecture)
- MySQL (PDO with Prepared Statements for SQL Injection prevention)
- Composer (Dependency Management)

**Frontend:**

- HTML5 / CSS3
- Bootstrap 5 (Responsive Grid & UI Components)
- jQuery (DOM Manipulation & AJAX)

**Third-party Libraries:**

- `vlucas/phpdotenv`: Environment variable management.
- `phpmailer/phpmailer`: Secure SMTP email delivery.

---

## 📂 Directory Structure

The project strictly follows the Model-View-Controller (MVC) design pattern:

```text
restaurant_project/
├── app/
│   ├── core/           # Core classes (Database Connection, Base Layouts)
│   ├── modules/        # Feature modules (Auth, Product, Menu, Reservation, User)
│   │   ├── auth/       # -> Contains auth_controller, auth_model, auth_service, views
│   │   └── ...
├── public/             # Publicly accessible directory (Document Root)
|   ├── api/
│   ├── css/
│   ├── js/
│   ├── images/
│   ├── index.php       # The Front Controller (Routing hub)
│   └── .htaccess       # URL Rewriting rules
├── vendor/             # Composer dependencies (Ignored in Git)
├── .env.example        # Environment variables template
├── composer.json       # Project dependencies list
└── README.md
```
