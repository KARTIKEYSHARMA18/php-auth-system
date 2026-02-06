# PHP Authentication System

This project demonstrates a secure PHP authentication system built using core PHP and MySQL.

## Features
- Contact form with validation and XSS protection
- Signup with email uniqueness check
- Secure password hashing using password_hash()
- Login using password_verify()
- Session-based authentication
- PRG (Post/Redirect/Get) pattern to prevent resubmission

## Tech Stack
- PHP (Core)
- MySQL
- HTML/CSS

## Security Practices Used
- Server-side validation
- Output escaping (XSS prevention)
- Password hashing
- Generic login error messages
- Session-based authentication

## How to Run
1. Import database from `database/schema.sql`
2. Update DB credentials in PHP files
3. Run on localhost using XAMPP/WAMP
