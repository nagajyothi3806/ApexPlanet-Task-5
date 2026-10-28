# 12-minute presentation script — LearnSpace

Use this as a speaking guide while screen recording your own tested application. Replace the bracketed items with your real repository and deployed URL. Do not claim a deployment or email delivery works until you have tested it.

## 0:00–1:00 — Introduction
“Hello, this is my ApexPlanet Task 5 capstone project, LearnSpace, an e-learning portal. The goal is to make course discovery and learner progress simple, while giving administrators a view of platform activity. The application uses PHP, MySQL, HTML, CSS and JavaScript.”

## 1:00–2:00 — Problem and solution
“Learners need to find courses and monitor progress. Administrators need to maintain the catalogue and understand enrolment activity. LearnSpace combines a searchable course catalogue, account verification, enrolment, progress tracking and an analytics dashboard.”

## 2:00–3:15 — Architecture
“The browser renders the responsive interface. JavaScript uses the Fetch API to call the PHP search endpoint. PHP validates requests and uses PDO prepared statements to communicate with MySQL. The database has users, courses and enrollments tables.”

## 3:15–4:30 — Registration and verification
“Here I demonstrate registration. The application validates the form, stores the password as a hash, creates a time-limited OTP hash, and attempts to send the code by email. For a local demo, if mail transport is unavailable, the code is displayed as a development fallback. Production deployment must use configured SMTP and must not expose this fallback.”

## 4:30–5:15 — Login and access control
“After verification, the user can log in. The session ID is regenerated after authentication. Student pages require login, and administrator pages check the account role.”

## 5:15–6:45 — Course catalogue and AJAX
“The catalogue supports live text search and category filtering. Results update without a full page reload. The API returns JSON and uses prepared statements. The interface includes a no-results state.”

## 6:45–8:00 — Enrolment and progress
“I open a course and enrol as a student. The database prevents duplicate enrolments. In the dashboard I can update progress and see the saved percentage.”

## 8:00–9:30 — Admin management
“As an administrator I can add a course and review the course catalogue. This demonstrates the administrative workflow. The one-time admin creation helper is removed after initial setup.”

## 9:30–10:30 — Analytics
“The admin dashboard displays counts for students, courses, enrolments and completions. Chart.js visualises courses by category and the most enrolled courses.”

## 10:30–11:15 — Database and security
“The ER diagram shows users, courses and enrollments. Password hashing, hashed OTPs, expiry checks, prepared statements, output escaping, CSRF protection and role checks are included. A real deployment also needs HTTPS, configured SMTP, secure secrets and production hardening.”

## 11:15–12:00 — Conclusion
“To conclude, LearnSpace brings together course discovery, verified accounts, enrolment, progress tracking, admin management and analytics. The source code and setup documentation are available at [your GitHub URL]. The deployed version is [your live URL, if deployed]. Thank you.”

## Recording checklist
- Record the actual working app, not just slides.
- Show the home page, catalogue search/filter, registration/verification, login, enrolment, progress update, admin course management, charts, and GitHub repository.
- Keep personal passwords and private email details out of the recording.
- If email sending or hosting is not configured, explain that honestly.
