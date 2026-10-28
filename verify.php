<?php
require_once __DIR__.'/includes/db.php'; require_once __DIR__.'/includes/functions.php';
$page_title='Verify email'; $error=''; $email=$_SESSION['pending_email']??'';
if (!$email) redirect('register.php');
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $otp=trim($_POST['otp']??''); $stmt=db()->prepare('SELECT id,otp_hash,otp_expires_at,is_verified FROM users WHERE email=?'); $stmt->execute([$email]); $u=$stmt->fetch();
 if (!$u || !$u['otp_hash'] || strtotime($u['otp_expires_at'])<time() || !password_verify($otp,$u['otp_hash'])) $error='That code is invalid or expired. Please register again or request a new code.';
 else { db()->prepare('UPDATE users SET is_verified=1,otp_hash=NULL,otp_expires_at=NULL WHERE id=?')->execute([$u['id']]); unset($_SESSION['pending_email'],$_SESSION['dev_otp']); flash('Email verified. You can now log in.'); redirect('login.php'); }
}
require __DIR__.'/includes/header.php'; ?>
<div class="auth-wrap"><section class="panel auth-panel"><p class="eyebrow">ONE QUICK CHECK</p><h1>Verify your email</h1><p class="muted">Enter the six-digit code sent to <strong><?= e($email) ?></strong>.</p><?php if(!empty($_SESSION['dev_otp'])): ?><div class="alert info">Local development mode: email could not be sent. Demo code: <strong><?= e((string)$_SESSION['dev_otp']) ?></strong>. Configure email delivery before production.</div><?php endif; ?><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Verification code<input name="otp" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" required></label><button class="button full">Verify email</button></form></section></div>
<?php require __DIR__.'/includes/footer.php'; ?>
