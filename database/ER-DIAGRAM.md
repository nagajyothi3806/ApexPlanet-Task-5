# LearnSpace ER diagram

```mermaid
erDiagram
    USERS ||--o{ COURSES : instructs
    USERS ||--o{ ENROLLMENTS : makes
    COURSES ||--o{ ENROLLMENTS : has
    USERS {
      bigint id PK
      varchar name
      varchar email UK
      varchar password_hash
      enum role
      boolean is_verified
      varchar otp_hash
      datetime otp_expires_at
    }
    COURSES {
      bigint id PK
      varchar title
      text description
      varchar category
      enum level
      smallint duration_hours
      enum status
      bigint instructor_id FK
    }
    ENROLLMENTS {
      bigint id PK
      bigint user_id FK
      bigint course_id FK
      tinyint progress
      timestamp enrolled_at
      datetime completed_at
    }
```

`users` stores student/admin accounts and hashed verification codes. `courses` stores the learning catalogue. `enrollments` is the many-to-many bridge between students and courses and stores progress.
