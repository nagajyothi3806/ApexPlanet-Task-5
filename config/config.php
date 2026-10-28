<?php
declare(strict_types=1);
session_start();

define('APP_NAME', 'LearnSpace');
define('BASE_URL', '/LearnSpace_E_Learning_Portal');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'learnspace_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // Set this for your local MySQL installation.

// Configure an SMTP provider before using email OTP outside a local demo.
// PHP mail() is used as a simple default; on many local machines it will not send.
define('OTP_EXPIRY_MINUTES', 10);
