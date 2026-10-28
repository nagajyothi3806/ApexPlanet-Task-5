<?php
require_once __DIR__.'/includes/db.php'; require_once __DIR__.'/includes/functions.php';
$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT); if(!$id) { http_response_code(404); exit('Course not found'); }
$s=db()->prepare("SELECT c.*,u.name instructor FROM courses c LEFT JOIN users u ON u.id=c.instructor_id WHERE c.id=? AND c.status='published'"); $s->execute([$id]); $course=$s->fetch();
if(!$course) { http_response_code(404); exit('Course not found'); }
$page_title=$course['title'];
if($_SERVER['REQUEST_METHOD']==='POST') { require_login(); verify_csrf(); $s=db()->prepare('INSERT IGNORE INTO enrollments(user_id,course_id) VALUES(?,?)'); $s->execute([current_user()['id'],$id]); flash('You are enrolled in this course.'); redirect('dashboard.php'); }
require __DIR__.'/includes/header.php'; ?>
<section class="detail-layout"><div class="course-art detail-art"><?= e(mb_substr($course['category'],0,1)) ?></div><article><span class="pill"><?= e($course['category']) ?></span><h1><?= e($course['title']) ?></h1><p class="muted">By <?= e($course['instructor']??'LearnSpace team') ?> · <?= e($course['level']) ?> · <?= (int)$course['duration_hours'] ?> hours</p><p><?= nl2br(e($course['description'])) ?></p><?php if(current_user()): ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><button class="button">Enroll in course</button></form><?php else: ?><a class="button" href="<?= BASE_URL ?>/login.php">Log in to enroll</a><?php endif; ?></article></section>
<?php require __DIR__.'/includes/footer.php'; ?>
