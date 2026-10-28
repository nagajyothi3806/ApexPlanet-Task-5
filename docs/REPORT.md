# LearnSpace — E-Learning Portal
## ApexPlanet Internship Task 5: Capstone Project & Deployment

### 1. Abstract
LearnSpace is a responsive e-learning portal prototype that helps students discover courses, enrol in learning content, and track their progress. It includes account registration, email OTP verification, role-based access for students and administrators, AJAX-powered course search and category filtering, course management, and a Chart.js analytics dashboard. PHP handles server-side operations, MySQL stores application data, and HTML/CSS/JavaScript provide the user interface. The project demonstrates a compact full-stack workflow from database design through authentication and analytics.

### 2. Problem statement
Learners need a simple place to browse learning opportunities and keep track of progress, while administrators need a clear view of catalogue and enrolment activity. LearnSpace brings these tasks into one portal.

### 3. Objectives
- Provide a responsive and accessible course catalogue.
- Verify new accounts with a time-limited one-time code.
- Store passwords and OTPs as password hashes.
- Allow authenticated learners to enrol and update course progress.
- Support live search and category filtering without a full-page reload.
- Provide administrator course management and visual analytics.
- Document the schema, relationships, local setup, and demo workflow.

### 4. Technology stack
- Front end: HTML5, CSS3, JavaScript, Fetch API.
- Back end: PHP 8+ with PDO.
- Database: MySQL 8+ / MariaDB.
- Visualisation: Chart.js.
- Development environment: XAMPP or another PHP/MySQL environment.
- Source control: GitHub.

### 5. Main modules
1. Home and course catalogue.
2. Student registration and OTP verification.
3. Login/logout and session management.
4. Course details and enrolment.
5. Student dashboard and progress updates.
6. Admin analytics dashboard.
7. Admin course creation and deletion.
8. AJAX search API.

### 6. Database design
The database contains three main entities. `users` stores account identity, password hash, role and verification state. `courses` stores course content, category, level and instructor. `enrollments` connects users and courses and stores progress. A unique constraint on `(user_id, course_id)` prevents duplicate enrolments. Foreign keys preserve referential integrity, and indexes support catalogue filters and enrolment analytics. See `../database/ER-DIAGRAM.md` and `../database/schema.sql`.

### 7. Security and validation
- Passwords are stored with PHP `password_hash()` and checked with `password_verify()`.
- OTP values are stored as hashes and have an expiry time.
- PDO prepared statements are used for database values.
- Output is escaped before rendering HTML.
- CSRF tokens protect form submissions.
- Session IDs are regenerated after successful login.
- Admin pages check the authenticated role.
- Production deployment must use HTTPS, configured SMTP, secure cookie settings, backups, rate limits, and environment-based database secrets. The included `admin/create-admin.php` is a local one-time helper and must be deleted after creating an administrator.

### 8. AJAX search and filtering
The course catalogue calls `api/search_courses.php` through the Fetch API whenever the search term changes or the category changes. The API uses prepared statements and returns JSON. The interface updates course cards without reloading the page and displays a helpful empty state when no records match.

### 9. Analytics
The admin dashboard presents student count, course count, enrolment count and completions. Chart.js renders a doughnut chart for courses by category and a bar chart for enrolments by course. These metrics are generated from MySQL queries and update as the data changes.

### 10. Testing plan
| Test | Expected result |
|---|---|
| Register with invalid email | Form rejects the input |
| Register with short password | Form rejects the input |
| Register with valid details | User record created and OTP verification shown |
| Enter incorrect/expired OTP | Verification is rejected |
| Verify correct OTP | Account marked verified |
| Login with wrong password | Access denied |
| Login as student | Student dashboard opens |
| Search course title | Matching results shown without reload |
| Filter category | Only selected category is shown |
| Enrol twice in same course | Duplicate enrolment prevented |
| Update progress | Dashboard displays saved percentage |
| Open admin page as student | Access denied |
| Add/delete course as admin | Catalogue data changes |
| Open analytics | KPI values and charts render |

### 11. Deployment plan
1. Push the complete source to a public GitHub repository.
2. Deploy to a PHP-compatible host with MySQL support.
3. Create the database and import `database/schema.sql`.
4. Configure database credentials and `BASE_URL`.
5. Configure SMTP/email delivery for OTPs.
6. Create an administrator using the one-time local helper, then delete that helper.
7. Test registration, verification, search, enrolment, progress, and admin analytics over HTTPS.
8. Add the live URL to the GitHub README and final submission.

### 12. Limitations and future enhancements
This is a capstone prototype rather than a complete commercial learning management system. Production email delivery depends on SMTP configuration. Course content currently consists of catalogue metadata rather than a full lesson/video player. Future work could add password reset, OTP resend with rate limiting, lesson resources, quiz assessments, certificates, pagination, audit logs, and automated tests.

### 13. Conclusion
LearnSpace demonstrates the integration of database-backed full-stack features in a single responsive application. It combines account verification, course discovery, enrolment, progress tracking, administrative management, and analytics. Deployment and a final recorded walkthrough should be completed and tested in the chosen hosting environment before submission.
