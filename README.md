# LearnSpace — E-Learning Portal

A responsive full-stack e-learning portal prototype for ApexPlanet Internship Task 5.

## Features
- Student registration, password hashing and time-limited email OTP verification
- Login/logout with session regeneration
- Student/admin role checks
- Course catalogue and course detail pages
- AJAX live search and category filtering using Fetch API
- Enrolment and progress tracking
- Admin course creation/deletion
- Chart.js analytics dashboard
- MySQL schema, ER diagram, wireframes, report and 12-minute presentation script

## Requirements
- PHP 8.1+ with PDO MySQL enabled
- MySQL 8+ or compatible MariaDB
- XAMPP, WAMP, MAMP or PHP-capable hosting
- Internet access for Chart.js CDN in the admin dashboard

## Local setup with XAMPP
1. Copy this project folder into `C:\xampp\htdocs\LearnSpace_E_Learning_Portal`.
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open phpMyAdmin and import `database/schema.sql`. It creates `learnspace_db` and sample courses.
4. Check `config/config.php`. Default XAMPP credentials are host `127.0.0.1`, database `learnspace_db`, user `root`, blank password.
5. Visit `http://localhost/LearnSpace_E_Learning_Portal/`.
6. Register a student account. Configure your PHP mail/SMTP transport for email delivery. If local mail is unavailable, the development flow displays a fallback OTP on the verification page.
7. To create an administrator, visit `http://localhost/LearnSpace_E_Learning_Portal/admin/create-admin.php`, create an admin with a strong password, and **immediately delete `admin/create-admin.php`**. Do not publish this helper to a production server.
8. Log in with the administrator account and open the Admin link to manage courses and view charts.

## Important configuration
- If the deployed project uses a different URL path, update `BASE_URL` in `config/config.php`.
- Set database credentials using environment-specific configuration before deployment.
- Configure SMTP with a trusted provider. The sample `mail()` call may not send from a local development machine.
- Use HTTPS in production. Disable the local OTP fallback in production and implement rate limiting, OTP resend controls, and monitoring.
- Never commit real passwords, API keys, private user data, or production secrets.

## Repository contents
- `index.php`, `courses.php`, `course.php`: public pages
- `register.php`, `verify.php`, `login.php`, `logout.php`: authentication
- `dashboard.php`: student enrolments and progress
- `admin/`: analytics, course management, one-time admin setup helper
- `api/search_courses.php`: JSON search endpoint
- `database/`: schema and ER diagram
- `docs/`: wireframes, report and presentation script

## Submission checklist
- [ ] Import database and test locally
- [ ] Test student registration, OTP verification and login
- [ ] Test course search/filter, enrolment and progress
- [ ] Test admin course management and analytics
- [ ] Delete `admin/create-admin.php` after admin creation
- [ ] Push source to GitHub
- [ ] Deploy to PHP/MySQL hosting and test HTTPS
- [ ] Configure real email delivery
- [ ] Record and review the 12-minute presentation
- [ ] Add repository and live demo links to your final submission

## Note
This repository contains the application source and documentation. It does not claim that the application has been deployed or that email delivery is configured automatically.
