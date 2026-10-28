<?php
require_once __DIR__.'/includes/db.php'; require_once __DIR__.'/includes/functions.php';
$page_title='Create account'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $password=$_POST['password']??'';
 if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8) $error='Enter your name, a valid email, and a password of at least 8 characters.';
 else {
  $pdo=db(); $check=$pdo->prepare('SELECT id FROM users WHERE email=?'); $check->execute([$email]);
  if ($check->fetch()) $error='An account with this email already exists.';
  else {
   $otp=(string)random_int(100000,999999); $hash=password_hash($password,PASSWORD_DEFAULT);
   $stmt=$pdo->prepare('INSERT INTO users(name,email,password_hash,role,is_verified,otp_hash,otp_expires_at) VALUES(?,?,?,"student",0,?,DATE_ADD(NOW(), INTERVAL '.OTP_EXPIRY_MINUTES.' MINUTE))');
   $stmt->execute([$name,$email,$hash,password_hash($otp,PASSWORD_DEFAULT)]);
   $_SESSION['pending_email']=$email;
   $sent=@mail($email,'LearnSpace email verification',"Your LearnSpace verification code is: $otp\nIt expires in ".OTP_EXPIRY_MINUTES." minutes.",'From: no-reply@learnspace.local');
   // Development fallback: display the code only when mail transport is unavailable.
   $_SESSION['dev_otp']=$sent ? null : $otp;
   redirect('verify.php');
  }
 }
}
require __DIR__.'/includes/header.php'; ?>
<div class="auth-wrap"><section class="panel auth-panel"><p class="eyebrow">START LEARNING</p><h1>Create your account</h1><p class="muted">Join LearnSpace and keep your learning organised.</p><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Full name<input name="name" required maxlength="100" value="<?= e($_POST['name']??'') ?>"></label><label>Email address<input type="email" name="email" required value="<?= e($_POST['email']??'') ?>"></label><label>Password<input type="password" name="password" required minlength="8" autocomplete="new-password"><small>Use at least 8 characters.</small></label><button class="button full">Create account</button></form><p class="muted center">Already registered? <a href="<?= BASE_URL ?>/login.php">Log in</a></p></section></div>
<?php require __DIR__.'/includes/footer.php'; ?>
