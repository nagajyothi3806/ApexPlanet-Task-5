<?php
require_once __DIR__.'/../includes/db.php'; require_once __DIR__.'/../includes/functions.php';
header('Content-Type: application/json; charset=utf-8');
$q=trim($_GET['q']??''); $category=trim($_GET['category']??'');
$sql="SELECT c.id,c.title,c.description,c.category,c.level,c.duration_hours,u.name instructor FROM courses c LEFT JOIN users u ON u.id=c.instructor_id WHERE c.status='published'";
$args=[];
if ($q!=='') { $sql.=" AND (c.title LIKE ? OR c.description LIKE ? OR c.category LIKE ?)"; $like='%'.$q.'%'; array_push($args,$like,$like,$like); }
if ($category!=='') { $sql.=" AND c.category=?"; $args[]=$category; }
$sql.=" ORDER BY c.created_at DESC LIMIT 60";
try { $s=db()->prepare($sql); $s->execute($args); echo json_encode(['courses'=>$s->fetchAll()],JSON_UNESCAPED_UNICODE); }
catch(Throwable $ex) { http_response_code(500); echo json_encode(['error'=>'Could not load courses. Import the database schema first.']); }
