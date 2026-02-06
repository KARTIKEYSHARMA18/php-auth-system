# PHP Authentication System

This project demonstrates a secure authentication system built using **core PHP and MySQL**, without any frameworks.

It focuses on backend fundamentals such as validation, authentication, session handling, and secure password storage.

---

## Features

- User registration with server-side validation
- Email uniqueness check during registration
- Secure password hashing using `password_hash()`
- Login authentication using `password_verify()`
- Session-based authentication
- Protected dashboard for authenticated users
- Logout functionality
- PRG (Post/Redirect/Get) pattern to prevent form resubmission
- Output escaping to prevent XSS attacks

---

## Authentication Flow

1. **Register (`register.php`)**
   - User creates an account
   - Password is securely hashed before storing

2. **Login (`auth/login.php`)**
   - User credentials are verified
   - User ID is stored in session on success

3. **Dashboard (`dashboard.php`)**
   - Accessible only to authenticated users
   - User details are fetched using session ID

4. **Logout (`logout.php`)**
   - Session is destroyed
   - User is redirected to login page

---

## Tech Stack

- PHP (Core)
- MySQL
- HTML/CSS

---

## Security Practices Used

- Server-side input validation
- Output escaping (XSS prevention)
- Secure password hashing
- Generic login error messages (prevents user enumeration)
- Session-based authentication
- Protected routes using auth guards

---

## Project Structure

php-auth-system/
│
├── auth/
│ ├── login.php
│ └── signup.php
│
├── registrationform/
│ └── register.php
│
├── database/
│ └── schema.sql
│
├── dashboard.php
├── logout.php
├── db.php
├── style.css
└── README.md

---

## Database Schema

The project uses a MySQL database with the following rules:

- Email must be unique
- Passwords are stored using `password_hash()`
- User identity is stored in session using `user_id`
- User details are fetched on protected pages using session ID

The database schema can be found in:


---

## How to Run Locally

1. Import the database using `database/schema.sql`
2. Update database credentials in `db.php`
3. Run the project on localhost using XAMPP or WAMP
4. Access the application via browser

---

## Notes

This project is built intentionally using **core PHP** to demonstrate a strong understanding of backend fundamentals without relying on frameworks.
