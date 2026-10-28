<?php
// Run once locally, then DELETE this file. Change the credentials below before running.
require_once __DIR__.'/../includes/db.php';
$message='';
if($_SERVER['REQUEST_METHOD']==='POST') {
 $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $password=$_POST['password']??'';
 if($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<12) $message='Enter a name, valid email and password of at least 12 characters.';
 else { $s=db()->prepare("INSERT INTO users(name,email,password_hash,role,is_verified) VALUES(?,?,?,'admin',1)"); try{$s->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);$message='Admin created. Delete admin/create-admin.php now.';}catch(Throwable $e){$message='Could not create admin. The email may already exist.';} }
}
?><!doctype html><html><head><meta charset="utf-8"><title>One-time admin setup</title></head><body><h1>One-time admin setup</h1><p><?= htmlspecialchars($message,ENT_QUOTES,'UTF-8') ?></p><form method="post"><label>Name <input name="name" required></label><br><label>Email <input type="email" name="email" required></label><br><label>Password (12+ characters) <input type="password" name="password" minlength="12" required></label><br><button>Create admin</button></form><p><strong>Security:</strong> delete this file after creating the administrator.</p></body></html>
