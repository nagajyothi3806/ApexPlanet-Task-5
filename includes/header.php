<?php require_once __DIR__ . '/functions.php'; ?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title ?? APP_NAME) ?> | LearnSpace</title>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head><body><header class="topbar"><a class="brand" href="<?= BASE_URL ?>/index.php">LearnSpace<span>●</span></a>
<nav><a href="<?= BASE_URL ?>/courses.php">Courses</a>
<?php if (current_user()): ?><a href="<?= BASE_URL ?>/dashboard.php">Dashboard</a><?php if (current_user()['role']==='admin'): ?><a href="<?= BASE_URL ?>/admin/index.php">Admin</a><?php endif; ?><a href="<?= BASE_URL ?>/logout.php">Log out</a>
<?php else: ?><a href="<?= BASE_URL ?>/login.php">Log in</a><a class="nav-cta" href="<?= BASE_URL ?>/register.php">Join free</a><?php endif; ?>
</nav></header><main class="container"><?php show_flash(); ?>
