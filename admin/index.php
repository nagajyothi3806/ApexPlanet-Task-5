<?php
require_once __DIR__.'/../includes/db.php'; require_once __DIR__.'/../includes/functions.php'; require_admin();
$page_title='Admin analytics';
$stats=db()->query("SELECT (SELECT COUNT(*) FROM users WHERE role='student') students,(SELECT COUNT(*) FROM courses) courses,(SELECT COUNT(*) FROM enrollments) enrollments,(SELECT COUNT(*) FROM enrollments WHERE progress=100) completions")->fetch();
$cats=db()->query("SELECT category,COUNT(*) total FROM courses GROUP BY category ORDER BY total DESC")->fetchAll();
$recent=db()->query("SELECT c.title,COUNT(e.id) enrollments FROM courses c LEFT JOIN enrollments e ON e.course_id=c.id GROUP BY c.id ORDER BY enrollments DESC LIMIT 6")->fetchAll();
$page_title='Admin analytics'; require __DIR__.'/../includes/header.php'; ?>
<section class="page-heading"><p class="eyebrow">ADMINISTRATION</p><h1>Learning overview</h1><p class="muted">A quick view of platform activity.</p></section>
<div class="metric-row"><div class="metric"><span>Students</span><strong><?= (int)$stats['students'] ?></strong></div><div class="metric"><span>Courses</span><strong><?= (int)$stats['courses'] ?></strong></div><div class="metric"><span>Enrollments</span><strong><?= (int)$stats['enrollments'] ?></strong></div><div class="metric"><span>Completions</span><strong><?= (int)$stats['completions'] ?></strong></div></div>
<div class="grid analytics-grid"><section class="panel"><h2>Courses by category</h2><canvas id="categoryChart" height="220"></canvas></section><section class="panel"><h2>Most enrolled courses</h2><canvas id="enrollmentChart" height="220"></canvas></section></div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script><script>
const cats=<?= json_encode($cats) ?>, recent=<?= json_encode($recent) ?>;
new Chart(document.getElementById('categoryChart'),{type:'doughnut',data:{labels:cats.map(x=>x.category),datasets:[{data:cats.map(x=>Number(x.total))}]},options:{responsive:true,plugins:{legend:{position:'bottom'}}}});
new Chart(document.getElementById('enrollmentChart'),{type:'bar',data:{labels:recent.map(x=>x.title),datasets:[{label:'Enrollments',data:recent.map(x=>Number(x.enrollments))}]},options:{indexAxis:'y',responsive:true,scales:{x:{beginAtZero:true,ticks:{precision:0}}}}});
</script>
<section class="panel"><h2>Admin tools</h2><p>Manage course records and review learner activity.</p><a class="button" href="courses.php">Manage courses</a></section>
<?php require __DIR__.'/../includes/footer.php'; ?>
