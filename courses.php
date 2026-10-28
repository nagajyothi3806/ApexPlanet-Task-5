<?php
require_once __DIR__.'/includes/db.php'; require_once __DIR__.'/includes/functions.php';
$page_title='Course catalogue'; require __DIR__.'/includes/header.php';
$categories=[]; try { $categories=db()->query("SELECT DISTINCT category FROM courses WHERE status='published' ORDER BY category")->fetchAll(PDO::FETCH_COLUMN); } catch(Throwable $ex) {}
?>
<section class="page-heading"><p class="eyebrow">FIND YOUR NEXT SKILL</p><h1>Course catalogue</h1><p class="muted">Search by title or description, or filter by category.</p></section>
<div class="filters"><input id="courseSearch" type="search" placeholder="Search courses…" aria-label="Search courses"><select id="categoryFilter"><option value="">All categories</option><?php foreach($categories as $cat): ?><option value="<?= e($cat) ?>"><?= e($cat) ?></option><?php endforeach; ?></select></div>
<div id="courseResults" class="grid courses-grid" aria-live="polite"><p class="muted">Loading courses…</p></div>
<?php require __DIR__.'/includes/footer.php'; ?>
