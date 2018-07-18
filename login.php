<?php
// dump(__FILE__);
defined('IS_VALID') or define('IS_VALID', 1);
require_once("main.php");

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 24 * 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(24 * 3600);

// Start session
if (!session_id()) @session_start();

// ------------------------------------------------------------ //

if (isset($_SESSION['user_name']) and $_SESSION['user_name']) {
	echo('Redirecting ...');
	\Utility::func_redirect('index.php', 1);
	exit;
}

if (count($_POST) > 0 and $_POST['uname'] and $_POST['psw']) {
	if ($user = \Utility::func_check_login($_POST['uname'], $_POST['psw'])) {
		$_SESSION['user_name'] = $user;
		$_SESSION['message'] = 'Login successful!';
		return \Utility::func_redirect('index.php', 2);
	}

	$_SESSION['message'] = 'Login failed!';
	// header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Required</title>
	<meta charset="utf-8" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="googlebot" content="noindex" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="renderer" content="webkit" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="user-scalable=no,width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0" />
    <link rel="icon" href="<?php echo SELF_URL_NO_SCRIPT ?>bitmex/process.php?img=favicon" type="image/png" />
    <link rel="shortcut icon" href="<?php echo SELF_URL_NO_SCRIPT ?>bitmex/process.php?img=favicon" type="image/png" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
	<link href="assets/css/login-styles.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<script type="text/javascript">
		document.addEventListener('gesturestart', function (e) {
			e.preventDefault();
		});
	</script>
</head>
<body>
	<h2 class="title">Login</h2>
	<form class="modal-content animate" action="login.php" method="post" enctype="multipart/form-data">
		<div class="imgcontainer">
			<?php if (isset($_SESSION['user_name']) and $_SESSION['message']): ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION['message']; ?>
				</div>
			<?php $_SESSION['message'] = null; endif; ?>
			<?php /*
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
			*/ ?>
			<img src="<?php echo SELF_URL_NO_SCRIPT ?>bitmex/process.php?img=logo" alt="Avatar" class="avatar">
		</div>
		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="uname" required>
			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="psw" required>
			<button type="submit">Login</button>
			<?php /*
			<label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
			*/ ?>
		</div>
		<?php /*
		<div class="container" style="background-color:#f1f1f1">
			<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
			<span class="psw">Forgot <a href="#">password?</a></span>
		</div>
		*/ ?>
	</form>
</body>
</html>