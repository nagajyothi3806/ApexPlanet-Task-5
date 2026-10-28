<?php
require_once __DIR__.'/includes/db.php'; require_once __DIR__.'/includes/functions.php';
$page_title='Log in'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $email=strtolower(trim($_POST['email']??'')); $password=$_POST['password']??'';
 $stmt=db()->prepare('SELECT id,name,email,password_hash,role,is_verified FROM users WHERE email=?'); $stmt->execute([$email]); $u=$stmt->fetch();
 if (!$u || !password_verify($password,$u['password_hash'])) $error='Email or password is incorrect.';
 elseif (!(int)$u['is_verified']) $error='Please verify your email before logging in.';
 else { session_regenerate_id(true); $_SESSION['user']=['id'=>(int)$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']]; redirect('dashboard.php'); }
}
require __DIR__.'/includes/header.php'; ?>
<div class="auth-wrap"><section class="panel auth-panel"><p class="eyebrow">WELCOME BACK</p><h1>Log in to LearnSpace</h1><p class="muted">Pick up right where you left off.</p><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" required autocomplete="current-password"></label><button class="button full">Log in</button></form><p class="muted center">New here? <a href="<?= BASE_URL ?>/register.php">Create an account</a></p></section></div>
<?php require __DIR__.'/includes/footer.php'; ?>
