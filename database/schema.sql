CREATE DATABASE IF NOT EXISTS learnspace_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE learnspace_db;

CREATE TABLE IF NOT EXISTS users (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('student','admin') NOT NULL DEFAULT 'student',
 is_verified TINYINT(1) NOT NULL DEFAULT 0,
 otp_hash VARCHAR(255) NULL,
 otp_expires_at DATETIME NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS courses (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(180) NOT NULL,
 description TEXT NOT NULL,
 category VARCHAR(80) NOT NULL DEFAULT 'General',
 level ENUM('Beginner','Intermediate','Advanced') NOT NULL DEFAULT 'Beginner',
 duration_hours SMALLINT UNSIGNED NOT NULL DEFAULT 1,
 status ENUM('draft','published','archived') NOT NULL DEFAULT 'published',
 instructor_id BIGINT UNSIGNED NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_courses_instructor FOREIGN KEY (instructor_id) REFERENCES users(id) ON DELETE SET NULL,
 INDEX idx_courses_status_category (status,category),
 FULLTEXT INDEX idx_courses_search (title,description)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS enrollments (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 user_id BIGINT UNSIGNED NOT NULL,
 course_id BIGINT UNSIGNED NOT NULL,
 progress TINYINT UNSIGNED NOT NULL DEFAULT 0,
 enrolled_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 completed_at DATETIME NULL,
 CONSTRAINT chk_progress CHECK (progress BETWEEN 0 AND 100),
 CONSTRAINT fk_enroll_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 CONSTRAINT fk_enroll_course FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
 UNIQUE KEY uq_user_course (user_id,course_id),
 INDEX idx_enroll_course_progress (course_id,progress)
) ENGINE=InnoDB;

INSERT INTO courses(title,description,category,level,duration_hours,status)
SELECT 'Python Foundations','Learn variables, control flow, functions and practical Python problem solving.','Programming','Beginner',8,'published'
WHERE NOT EXISTS (SELECT 1 FROM courses WHERE title='Python Foundations');
INSERT INTO courses(title,description,category,level,duration_hours,status)
SELECT 'SQL Essentials','Practice relational databases, filtering, grouping, joins and useful queries.','Databases','Beginner',6,'published'
WHERE NOT EXISTS (SELECT 1 FROM courses WHERE title='SQL Essentials');
INSERT INTO courses(title,description,category,level,duration_hours,status)
SELECT 'Frontend Web Design','Build responsive interfaces with semantic HTML, modern CSS and JavaScript.','Web Development','Intermediate',10,'published'
WHERE NOT EXISTS (SELECT 1 FROM courses WHERE title='Frontend Web Design');
INSERT INTO courses(title,description,category,level,duration_hours,status)
SELECT 'Data Structures Basics','Understand arrays, stacks, queues, searching and sorting with examples.','Programming','Intermediate',12,'published'
WHERE NOT EXISTS (SELECT 1 FROM courses WHERE title='Data Structures Basics');
