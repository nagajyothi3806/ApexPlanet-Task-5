<?php
require_once __DIR__.'/includes/db.php'; require_once __DIR__.'/includes/functions.php';
$page_title='Learn without limits';
$featured=[];
try { $featured=db()->query("SELECT c.*, u.name AS instructor FROM courses c LEFT JOIN users u ON u.id=c.instructor_id WHERE c.status='published' ORDER BY c.created_at DESC LIMIT 3")->fetchAll(); } catch(Throwable $ex) {}
require __DIR__.'/includes/header.php';
?>
<section class="hero"><div><p class="eyebrow">YOUR NEXT CHAPTER STARTS HERE</p><h1>Skills that move<br><em>you forward.</em></h1><p class="hero-copy">Practical courses, clear learning paths, and progress you can actually see.</p><div class="hero-actions"><a class="button" href="<?= BASE_URL ?>/courses.php">Explore courses</a><a class="button secondary" href="<?= BASE_URL ?>/register.php">Create free account</a></div><div class="stats"><div><strong>Learn</strong><span>at your pace</span></div><div><strong>Track</strong><span>your progress</span></div><div><strong>Grow</strong><span>every week</span></div></div></div><div class="hero-card"><div class="course-art art-purple">✦</div><p class="eyebrow">FEATURED LEARNING</p><h3>Small steps. Real skills.</h3><p>Build a routine that works for you.</p><div class="progress"><span style="width:72%"></span></div><small>Keep your momentum going</small></div></section>
<section class="section-head"><div><p class="eyebrow">START EXPLORING</p><h2>Popular courses</h2></div><a href="<?= BASE_URL ?>/courses.php">View all →</a></section>
<div class="grid courses-grid">
<?php if ($featured): foreach($featured as $c): ?>
<article class="course-card"><div class="course-art"><?= e(mb_substr($c['category'],0,1)) ?></div><div class="card-body"><span class="pill"><?= e($c['category']) ?></span><h3><?= e($c['title']) ?></h3><p><?= e($c['description']) ?></p><div class="card-foot"><span><?= e($c['instructor'] ?? 'LearnSpace team') ?></span><a href="<?= BASE_URL ?>/course.php?id=<?= (int)$c['id'] ?>">Details →</a></div></div></article>
<?php endforeach; else: ?>
<article class="course-card"><div class="course-art">01</div><div class="card-body"><span class="pill">Getting started</span><h3>Build your learning habit</h3><p>Import the sample course records using database/schema.sql to populate the catalogue.</p><a href="<?= BASE_URL ?>/courses.php">Browse catalogue →</a></div></article>
<?php endif; ?>
</div>
<?php require __DIR__.'/includes/footer.php'; ?>
